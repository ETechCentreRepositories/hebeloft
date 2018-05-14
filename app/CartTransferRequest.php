<?php

namespace App;

class CartTransferRequest {

    public $items = null;
    public $totalQty = 0;
    public $location = "";
    public $date = "";

    public function __construct($oldTransferRequestCart) {
        if($oldTransferRequestCart) {
            $this->items = $oldTransferRequestCart->items;
            $this->totalQty = $oldTransferRequestCart->totalQty;
            $this->location = $oldTransferRequestCart->location;
            $this->date = $oldTransferRequestCart->date;
        }
    }

    public function add($item, $id, $location, $date) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'location' => $location, 'date' => $date];
            if($this->items) {
                if(array_key_exists($id, $this->items)) {
                    $storedItem = $this->items[$id];
                }
            }
            $storedItem['qty']++;
            $this->items[$id] = $storedItem;
            $this->totalQty++;
            
    }
}