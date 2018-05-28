<?php

namespace App;

class CartSalesRecord {

    public $items = null;
    public $totalQty = 0;
    public $date = "";
    public $remarks = "";
    public $receiptNumber = "";

    public function __construct($oldSalesRecordCart) {
        if($oldSalesRecordCart) {
            $this->items = $oldSalesRecordCart->items;
            $this->totalQty = $oldSalesRecordCart->totalQty;
            $this->date = $oldSalesRecordCart->date;
            $this->remarks = $oldSalesRecordCart->remarks;
            $this->receiptNumber = $oldSalesRecordCart->receiptNumber;
        }
    }

    public function add($item, $id, $price, $quantity, $date, $remarks, $receiptNumber) {
        $storedItem = ['qty' => 0, 'price' => $price, 'item' => $item];
            if($this->items) {
                if(array_key_exists($id, $this->items)) {
                    $storedItem = $this->items[$id];
                }
            }
            $storedItem['qty'] += $quantity;
            $this->items[$id] = $storedItem;
            $this->totalQty += $quantity;
            $this->date = $date;
            $this->remarks = $remarks;
            $this->receiptNumber = $receiptNumber;
    }
}