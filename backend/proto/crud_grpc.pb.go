// Code generated by protoc-gen-go-grpc. DO NOT EDIT.
// versions:
// - protoc-gen-go-grpc v1.5.1
// - protoc             v5.29.0
// source: crud.proto

package proto

import (
	context "context"
	grpc "google.golang.org/grpc"
	codes "google.golang.org/grpc/codes"
	status "google.golang.org/grpc/status"
)

// This is a compile-time assertion to ensure that this generated file
// is compatible with the grpc package it is being compiled against.
// Requires gRPC-Go v1.64.0 or later.
const _ = grpc.SupportPackageIsVersion9

const (
	CrudService_CreateItem_FullMethodName = "/proto.CrudService/CreateItem"
	CrudService_ReadItem_FullMethodName   = "/proto.CrudService/ReadItem"
	CrudService_UpdateItem_FullMethodName = "/proto.CrudService/UpdateItem"
	CrudService_DeleteItem_FullMethodName = "/proto.CrudService/DeleteItem"
	CrudService_ListItems_FullMethodName  = "/proto.CrudService/ListItems"
)

// CrudServiceClient is the client API for CrudService service.
//
// For semantics around ctx use and closing/ending streaming RPCs, please refer to https://pkg.go.dev/google.golang.org/grpc/?tab=doc#ClientConn.NewStream.
type CrudServiceClient interface {
	CreateItem(ctx context.Context, in *Item, opts ...grpc.CallOption) (*ResponseWithId, error)
	ReadItem(ctx context.Context, in *ItemId, opts ...grpc.CallOption) (*Item, error)
	UpdateItem(ctx context.Context, in *Item, opts ...grpc.CallOption) (*Response, error)
	DeleteItem(ctx context.Context, in *ItemId, opts ...grpc.CallOption) (*Response, error)
	ListItems(ctx context.Context, in *ItemList, opts ...grpc.CallOption) (*ItemList, error)
}

type crudServiceClient struct {
	cc grpc.ClientConnInterface
}

func NewCrudServiceClient(cc grpc.ClientConnInterface) CrudServiceClient {
	return &crudServiceClient{cc}
}

func (c *crudServiceClient) CreateItem(ctx context.Context, in *Item, opts ...grpc.CallOption) (*ResponseWithId, error) {
	cOpts := append([]grpc.CallOption{grpc.StaticMethod()}, opts...)
	out := new(ResponseWithId)
	err := c.cc.Invoke(ctx, CrudService_CreateItem_FullMethodName, in, out, cOpts...)
	if err != nil {
		return nil, err
	}
	return out, nil
}

func (c *crudServiceClient) ReadItem(ctx context.Context, in *ItemId, opts ...grpc.CallOption) (*Item, error) {
	cOpts := append([]grpc.CallOption{grpc.StaticMethod()}, opts...)
	out := new(Item)
	err := c.cc.Invoke(ctx, CrudService_ReadItem_FullMethodName, in, out, cOpts...)
	if err != nil {
		return nil, err
	}
	return out, nil
}

func (c *crudServiceClient) UpdateItem(ctx context.Context, in *Item, opts ...grpc.CallOption) (*Response, error) {
	cOpts := append([]grpc.CallOption{grpc.StaticMethod()}, opts...)
	out := new(Response)
	err := c.cc.Invoke(ctx, CrudService_UpdateItem_FullMethodName, in, out, cOpts...)
	if err != nil {
		return nil, err
	}
	return out, nil
}

func (c *crudServiceClient) DeleteItem(ctx context.Context, in *ItemId, opts ...grpc.CallOption) (*Response, error) {
	cOpts := append([]grpc.CallOption{grpc.StaticMethod()}, opts...)
	out := new(Response)
	err := c.cc.Invoke(ctx, CrudService_DeleteItem_FullMethodName, in, out, cOpts...)
	if err != nil {
		return nil, err
	}
	return out, nil
}

func (c *crudServiceClient) ListItems(ctx context.Context, in *ItemList, opts ...grpc.CallOption) (*ItemList, error) {
	cOpts := append([]grpc.CallOption{grpc.StaticMethod()}, opts...)
	out := new(ItemList)
	err := c.cc.Invoke(ctx, CrudService_ListItems_FullMethodName, in, out, cOpts...)
	if err != nil {
		return nil, err
	}
	return out, nil
}

// CrudServiceServer is the server API for CrudService service.
// All implementations must embed UnimplementedCrudServiceServer
// for forward compatibility.
type CrudServiceServer interface {
	CreateItem(context.Context, *Item) (*ResponseWithId, error)
	ReadItem(context.Context, *ItemId) (*Item, error)
	UpdateItem(context.Context, *Item) (*Response, error)
	DeleteItem(context.Context, *ItemId) (*Response, error)
	ListItems(context.Context, *ItemList) (*ItemList, error)
	mustEmbedUnimplementedCrudServiceServer()
}

// UnimplementedCrudServiceServer must be embedded to have
// forward compatible implementations.
//
// NOTE: this should be embedded by value instead of pointer to avoid a nil
// pointer dereference when methods are called.
type UnimplementedCrudServiceServer struct{}

func (UnimplementedCrudServiceServer) CreateItem(context.Context, *Item) (*ResponseWithId, error) {
	return nil, status.Errorf(codes.Unimplemented, "method CreateItem not implemented")
}
func (UnimplementedCrudServiceServer) ReadItem(context.Context, *ItemId) (*Item, error) {
	return nil, status.Errorf(codes.Unimplemented, "method ReadItem not implemented")
}
func (UnimplementedCrudServiceServer) UpdateItem(context.Context, *Item) (*Response, error) {
	return nil, status.Errorf(codes.Unimplemented, "method UpdateItem not implemented")
}
func (UnimplementedCrudServiceServer) DeleteItem(context.Context, *ItemId) (*Response, error) {
	return nil, status.Errorf(codes.Unimplemented, "method DeleteItem not implemented")
}
func (UnimplementedCrudServiceServer) ListItems(context.Context, *ItemList) (*ItemList, error) {
	return nil, status.Errorf(codes.Unimplemented, "method ListItems not implemented")
}
func (UnimplementedCrudServiceServer) mustEmbedUnimplementedCrudServiceServer() {}
func (UnimplementedCrudServiceServer) testEmbeddedByValue()                     {}

// UnsafeCrudServiceServer may be embedded to opt out of forward compatibility for this service.
// Use of this interface is not recommended, as added methods to CrudServiceServer will
// result in compilation errors.
type UnsafeCrudServiceServer interface {
	mustEmbedUnimplementedCrudServiceServer()
}

func RegisterCrudServiceServer(s grpc.ServiceRegistrar, srv CrudServiceServer) {
	// If the following call pancis, it indicates UnimplementedCrudServiceServer was
	// embedded by pointer and is nil.  This will cause panics if an
	// unimplemented method is ever invoked, so we test this at initialization
	// time to prevent it from happening at runtime later due to I/O.
	if t, ok := srv.(interface{ testEmbeddedByValue() }); ok {
		t.testEmbeddedByValue()
	}
	s.RegisterService(&CrudService_ServiceDesc, srv)
}

func _CrudService_CreateItem_Handler(srv interface{}, ctx context.Context, dec func(interface{}) error, interceptor grpc.UnaryServerInterceptor) (interface{}, error) {
	in := new(Item)
	if err := dec(in); err != nil {
		return nil, err
	}
	if interceptor == nil {
		return srv.(CrudServiceServer).CreateItem(ctx, in)
	}
	info := &grpc.UnaryServerInfo{
		Server:     srv,
		FullMethod: CrudService_CreateItem_FullMethodName,
	}
	handler := func(ctx context.Context, req interface{}) (interface{}, error) {
		return srv.(CrudServiceServer).CreateItem(ctx, req.(*Item))
	}
	return interceptor(ctx, in, info, handler)
}

func _CrudService_ReadItem_Handler(srv interface{}, ctx context.Context, dec func(interface{}) error, interceptor grpc.UnaryServerInterceptor) (interface{}, error) {
	in := new(ItemId)
	if err := dec(in); err != nil {
		return nil, err
	}
	if interceptor == nil {
		return srv.(CrudServiceServer).ReadItem(ctx, in)
	}
	info := &grpc.UnaryServerInfo{
		Server:     srv,
		FullMethod: CrudService_ReadItem_FullMethodName,
	}
	handler := func(ctx context.Context, req interface{}) (interface{}, error) {
		return srv.(CrudServiceServer).ReadItem(ctx, req.(*ItemId))
	}
	return interceptor(ctx, in, info, handler)
}

func _CrudService_UpdateItem_Handler(srv interface{}, ctx context.Context, dec func(interface{}) error, interceptor grpc.UnaryServerInterceptor) (interface{}, error) {
	in := new(Item)
	if err := dec(in); err != nil {
		return nil, err
	}
	if interceptor == nil {
		return srv.(CrudServiceServer).UpdateItem(ctx, in)
	}
	info := &grpc.UnaryServerInfo{
		Server:     srv,
		FullMethod: CrudService_UpdateItem_FullMethodName,
	}
	handler := func(ctx context.Context, req interface{}) (interface{}, error) {
		return srv.(CrudServiceServer).UpdateItem(ctx, req.(*Item))
	}
	return interceptor(ctx, in, info, handler)
}

func _CrudService_DeleteItem_Handler(srv interface{}, ctx context.Context, dec func(interface{}) error, interceptor grpc.UnaryServerInterceptor) (interface{}, error) {
	in := new(ItemId)
	if err := dec(in); err != nil {
		return nil, err
	}
	if interceptor == nil {
		return srv.(CrudServiceServer).DeleteItem(ctx, in)
	}
	info := &grpc.UnaryServerInfo{
		Server:     srv,
		FullMethod: CrudService_DeleteItem_FullMethodName,
	}
	handler := func(ctx context.Context, req interface{}) (interface{}, error) {
		return srv.(CrudServiceServer).DeleteItem(ctx, req.(*ItemId))
	}
	return interceptor(ctx, in, info, handler)
}

func _CrudService_ListItems_Handler(srv interface{}, ctx context.Context, dec func(interface{}) error, interceptor grpc.UnaryServerInterceptor) (interface{}, error) {
	in := new(ItemList)
	if err := dec(in); err != nil {
		return nil, err
	}
	if interceptor == nil {
		return srv.(CrudServiceServer).ListItems(ctx, in)
	}
	info := &grpc.UnaryServerInfo{
		Server:     srv,
		FullMethod: CrudService_ListItems_FullMethodName,
	}
	handler := func(ctx context.Context, req interface{}) (interface{}, error) {
		return srv.(CrudServiceServer).ListItems(ctx, req.(*ItemList))
	}
	return interceptor(ctx, in, info, handler)
}

// CrudService_ServiceDesc is the grpc.ServiceDesc for CrudService service.
// It's only intended for direct use with grpc.RegisterService,
// and not to be introspected or modified (even as a copy)
var CrudService_ServiceDesc = grpc.ServiceDesc{
	ServiceName: "proto.CrudService",
	HandlerType: (*CrudServiceServer)(nil),
	Methods: []grpc.MethodDesc{
		{
			MethodName: "CreateItem",
			Handler:    _CrudService_CreateItem_Handler,
		},
		{
			MethodName: "ReadItem",
			Handler:    _CrudService_ReadItem_Handler,
		},
		{
			MethodName: "UpdateItem",
			Handler:    _CrudService_UpdateItem_Handler,
		},
		{
			MethodName: "DeleteItem",
			Handler:    _CrudService_DeleteItem_Handler,
		},
		{
			MethodName: "ListItems",
			Handler:    _CrudService_ListItems_Handler,
		},
	},
	Streams:  []grpc.StreamDesc{},
	Metadata: "crud.proto",
}