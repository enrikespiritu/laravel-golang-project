<?php

namespace App\Http\Controllers;

use Proto\CrudServiceClient;
use Illuminate\Http\Request;
use Grpc\ChannelCredentials;
use Proto\Item;
use Proto\ItemId;
use Proto\PBEmpty;
use Proto\ItemList;
use Proto\GPBMetadata\Crud;
use Illuminate\Support\Facades\Log;


class GrpcClientController extends Controller {
    private $client;

    public function __construct() {
        $this->client = new CrudServiceClient('localhost:50051', [
            'credentials' => ChannelCredentials::createInsecure(),
        ]);
    }

    public function createItem(Request $request) {
        $item = new Item();
        $item->setId($request->id);
        $item->setReceiptNumber($request->receipt_number);
        $item->setBus($request->bus);
        $item->setRouteFrom($request->route_from);
        $item->setRouteTo($request->route_to);
        $item->setSchedule($request->schedule);
        $item->setTrip($request->trip);
        $item->setNumTickets($request->num_tickets);
        $item->setPrice($request->price);

        list($response, $status) = $this->client->CreateItem($item)->wait();

        return response()->json([
            'message' => $response->getMessage(),
            'id' => $response->getId(),
        ]);
    }

    public function readItem($id) {
        $itemId = new ItemId();
        $itemId->setId($id);

        list($item, $status) = $this->client->ReadItem($itemId)->wait();

        return response()->json([
            'id' => intValue($item->getId()),
            'receipt_number' => $item->getReceiptNumber(),
            'bus' => $item->getBus(),
            'route_from' => $item->getRouteFrom(),
            'route_to' => $item->getRouteTo(),
            'schedule' => $item->getSchedule(),
            'trip' => $item->getTrip(),
            'num_tickets' => $item->getNumTickets(),
            'price' => $item->getPrice(),
        ]);
    }

    public function updateItem(Request $request, $id) {
        $item = new Item();
        $item->setId($request->id);
        $item->setReceiptNumber($request->receipt_number);
        $item->setBus($request->bus);
        $item->setRouteFrom($request->route_from);
        $item->setRouteTo($request->route_to);
        $item->setSchedule($request->schedule);
        $item->setTrip($request->trip);
        $item->setNumTickets($request->num_tickets);
        $item->setPrice($request->price);

        list($response, $status) = $this->client->UpdateItem($item)->wait();

        return response()->json(['message' => $response->getMessage()]);
    }

    public function deleteItem($id) {
        $itemId = new ItemId();
        $itemId->setId($id);

        list($response, $status) = $this->client->DeleteItem($itemId)->wait();

        return response()->json(['message' => $response->getMessage()]);
    }

    public function listItems(Request $request) {
        $list = new ItemList();
        list($response, $status) = $this->client->ListItems($list)->wait();
        
        if ($status->code !== \Grpc\STATUS_OK) {
            return response()->json(['error' => 'Failed to fetch items'], 500);
        }

        if ($response === null) {
            return response()->json(['error' => 'No items found'], 404);
        }

        $itemList = [];
        foreach ($response->getItems() as $item) {
            $itemList[] = [
                'id' => $item->getId(),
                'receipt_number' => $item->getReceiptNumber(),
                'bus' => $item->getBus(),
                'route_from' => $item->getRouteFrom(),
                'route_to' => $item->getRouteTo(),
                'schedule' => $item->getSchedule(),
                'trip' => $item->getTrip(),
                'num_tickets' => $item->getNumTickets(),
                'price' => $item->getPrice(),
            ];
        }

        return response()->json(['items' => $itemList]);
    }

    public function showUpdateItemView($id) {        
        $itemId = new ItemId();
        $itemId->setId($id);
        
        list($item, $status) = $this->client->ReadItem($itemId)->wait();        
       
        if ($item) {
            $itemArray = [
                'id' => $item->getId(),
                'receipt_number' => $item->getReceiptNumber(),
                'bus' => $item->getBus(),
                'route_from' => $item->getRouteFrom(),
                'route_to' => $item->getRouteTo(),
                'schedule' => $item->getSchedule(),
                'trip' => $item->getTrip(),
                'num_tickets' => $item->getNumTickets(),
                'price' => $item->getPrice(),
            ];
            
            return view('update-item', ['item' => $itemArray]);
        } else {
            return redirect()->back()->with('error', 'Item not found');
        }
    }

}
