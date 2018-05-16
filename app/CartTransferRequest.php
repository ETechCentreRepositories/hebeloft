<?php

namespace App;

class CartTransferRequest {

    public $items = null;
    public $totalQty = 0;
    public $outlet = "";
    public $date = "";

    public function __construct($oldTransferRequestCart) {
        if($oldTransferRequestCart) {
            $this->items = $oldTransferRequestCart->items;
            $this->totalQty = $oldTransferRequestCart->totalQty;
            $this->outlet = $oldTransferRequestCart->outlet;
            $this->date = $oldTransferRequestCart->date;
        }
    }

    public function add($item, $id, $quantity, $outlet, $date) {
        $storedItem = ['qty' => 0, 'item' => $item];
            if($this->items) {
                if(array_key_exists($id, $this->items)) {
                    $storedItem = $this->items[$id];
                }
            }
            $storedItem['qty'] += $quantity;
            $this->items[$id] = $storedItem;
            $this->totalQty += $quantity;
            $this->outlet = $outlet;
            $this->date = $date;
    }

    
}