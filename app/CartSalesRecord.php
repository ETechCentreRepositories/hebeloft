<?php

namespace App;

class CartSalesRecord {

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $outlet = "";
    public $date = "";
    public $remarks = "";
    public $receiptNumber = "";

    public function __construct($oldSalesRecordCart) {
        if($oldSalesRecordCart) {
            $this->items = $oldSalesRecordCart->items;
            $this->totalQty = $oldSalesRecordCart->totalQty;
            $this->totalPrice = $oldSalesRecordCart->totalPrice;
            $this->outlet = $oldSalesRecordCart->outlet;
            $this->date = $oldSalesRecordCart->date;
            $this->remarks = $oldSalesRecordCart->remarks;
            $this->receiptNumber = $oldSalesRecordCart->receiptNumber;
        }
    }

    public function add($item, $id, $price, $quantity, $outlet, $date, $remarks, $receiptNumber) {
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
            $this->remarks = $remarks;
            $this->receiptNumber = $receiptNumber;
    }
}