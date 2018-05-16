<?php

namespace App;

class CartSalesRecord {

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $outlet = "";
    public $date = "";

    public function __construct($oldSalesRecordCart) {
        if($oldSalesRecordCart) {
            $this->items = $oldSalesRecordCart->items;
            $this->totalQty = $oldSalesRecordCart->totalQty;
            $this->totalPrice = $oldSalesRecordCart->totalPrice;
            $this->outlet = $oldSalesRecordCart->outlet;
            $this->date = $oldSalesRecordCart->date;
        }
    }

    public function add($item, $id, $price, $quantity, $outlet, $date) {
        $storedItem = ['qty' => 0, 'price' => $price, 'item' => $item];
            if($this->items) {
                if(array_key_exists($id, $this->items)) {
                    $storedItem = $this->items[$id];
                }
            }
            $storedItem['qty'] += $quantity;
            $storedItem['price'] = $price;
            $this->items[$id] = $storedItem;
            $this->totalQty += $quantity;
            $this->totalPrice += $price;
            $this->outlet = $outlet;
            $this->date = $date;
    }
}