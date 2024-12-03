package main

import (
    "backend/models"
    "backend/models/itemModel"
    "context"
    "fmt"
    "log"
    "net"
    "strconv"

    "google.golang.org/grpc"
    "google.golang.org/grpc/reflection"
    pb "backend/proto"
)

type server struct {
    pb.UnimplementedCrudServiceServer
    items map[string]*pb.Item
}

func (s *server) CreateItem(ctx context.Context, item *pb.Item) (*pb.ResponseWithId, error) {
    id, err := itemModel.AddItem(item)
    message := "Ticket added"
    if err != nil {
        message = fmt.Sprintf("Error adding: ", err)  
    }
    
    return &pb.ResponseWithId{Message: message, Id: strconv.Itoa(id)}, nil
}

func (s *server) UpdateItem(ctx context.Context, item *pb.Item) (*pb.Response, error) {    
    err := itemModel.UpdateItem(item)
    message := "Ticket updated"
    if err != nil {
        message = fmt.Sprintf("Error updating: ", err)  
    }
    return &pb.Response{Message: message}, nil
}

func (s *server) DeleteItem(ctx context.Context, id *pb.ItemId) (*pb.Response, error) {
    err := itemModel.DeleteItem(id.Id)
    message := "Ticket deleted"
    if err != nil {
        message = fmt.Sprintf("Error deleting: ", err)  
    }
    return &pb.Response{Message: message}, nil
}

func (s *server) ReadItem(ctx context.Context, id *pb.ItemId) (*pb.Item, error) {
    item, err := itemModel.GetId(id.Id)
    if err != nil {
        log.Println(err)
        return &pb.Item{}, nil
    }

    resItem := &pb.Item{
        Id:             strconv.Itoa(item.Id),
        ReceiptNumber:  item.ReceiptNumber,
        Bus:            item.Bus,
        RouteFrom:      item.RouteFrom,
        RouteTo:        item.RouteTo,
        Schedule:       item.Schedule,
        Trip:           item.Trip,
        NumTickets:     item.NumTickets,
        Price:          item.Price,
    }
    
    return resItem, nil
}

func (s *server) ListItems(ctx context.Context, req *pb.ItemList) (*pb.ItemList, error) {
    items, err := itemModel.GetAllItem()
    if err != nil {
        log.Println("GetAllItem error", err)
    }

    itemList := &pb.ItemList{}
    for _, item := range items {
        itemList.Items = append(itemList.Items, &pb.Item{
            Id:             strconv.Itoa(item.Id),
            ReceiptNumber:  item.ReceiptNumber,
            Bus:            item.Bus,
            RouteFrom:      item.RouteFrom,
            RouteTo:        item.RouteTo,
            Schedule:       item.Schedule,
            Trip:           item.Trip,
            NumTickets:     item.NumTickets,
            Price:          item.Price,
        })
    }
    
    return itemList, nil
}

func main() {
    err := models.InitXorm()
	if err != nil {
		log.Println("[InitXorm] error", err)
		panic(err)
	} else {
		log.Println("[InitXorm] success")

		//migration
		go itemModel.Migrate()
	}

    lis, err := net.Listen("tcp", ":50051")
    if err != nil {
        log.Fatalf("failed to listen: %v", err)
    }
    s := grpc.NewServer()
    pb.RegisterCrudServiceServer(s, &server{items: make(map[string]*pb.Item)})

    // Register reflection service on gRPC server. reflection.Register(s)
    reflection.Register(s)

    log.Printf("server listening at %v", lis.Addr())
    if err := s.Serve(lis); err != nil {
        log.Fatalf("failed to serve: %v", err)
    }
}
