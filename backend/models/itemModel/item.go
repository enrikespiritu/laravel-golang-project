package itemModel

import (	
	"backend/models"
	"fmt"
	"log"

	pb "backend/proto"
)

type Item struct {
	Id				int		`json:"id" xorm:"pk notnull autoincr"`
	ReceiptNumber	string	`json:"receipt_number" xorm:"varchar(100) notnull"`
	Bus 			string	`json:"bus" xorm:"varchar(100) notnull"`
	RouteFrom		string	`json:"route_from" xorm:"varchar(100) notnull"`
	RouteTo			string	`json:"route_to" xorm:"varchar(100) notnull"`
	Schedule		string	`json:"schedule" xorm:"varchar(100) notnull"`
	Trip			string	`json:"trip" xorm:"varchar(100) notnull"`
	NumTickets		string	`json:"num_tickets" xorm:"varchar(100) notnull"`
	Price			string	`json:"price" xorm:"varchar(100) notnull"`
}

func Migrate() {
	// err := models.Engine.DropTables(&Item{})
	// if err != nil {
	// 	panic(err)
	// }

	err := models.Engine.Sync(new(Item))
	if err != nil {
		log.Println("Item sync error:", err)
	} else {
		log.Println("Item sync success")
	}
}

func GetAllItem() ([]Item, error) {
	var items []Item
	_, err := models.Engine.OrderBy("id").FindAndCount(&items)
	if err != nil {
		return nil, err
	}

	return items, nil
}

func GetId(id string) (*Item, error) {
	var item Item
	res, err := models.Engine.Where("id = ?", id).Get(&item)
	if err != nil {
		return nil, err
	} else if !res {
		return nil, fmt.Errorf("item not found")
	}

	return &item, nil
}

func AddItem(req *pb.Item) (int, error) {
	item := Item{
		ReceiptNumber: req.ReceiptNumber,
		Bus: req.Bus,
		RouteFrom: req.RouteFrom,
		RouteTo: req.RouteTo,
		Schedule: req.Schedule,
		Trip: req.Trip,
		NumTickets: req.NumTickets,
		Price: req.Price,
	}

	_, err := models.Engine.Insert(&item)
	if err != nil {
		return 0, err
	}

	return item.Id, nil
}

func UpdateItem(req *pb.Item) error {
	update := Item{
		ReceiptNumber: req.ReceiptNumber,
		Bus: req.Bus,
		RouteFrom: req.RouteFrom,
		RouteTo: req.RouteTo,
		Schedule: req.Schedule,
		Trip: req.Trip,
		NumTickets: req.NumTickets,
		Price: req.Price,
	}

	res, err := models.Engine.Where("id = ?", req.Id).Update(&update)
	if err != nil {
		return err
	} else if res == 0 {
		return fmt.Errorf("item not found")
	}

	return nil
}

func DeleteItem(id string) error {
	var item Item
	res, err := models.Engine.Where("id = ?", id).Delete(item)
	if err != nil {
		return err
	} else if res == 0 {
		return fmt.Errorf("item not found")
	}

	return nil
}