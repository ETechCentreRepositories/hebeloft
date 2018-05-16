<?php

namespace App;

class CartSalesOrder {

    public $items = null;
    public $totalQty = 0;
    public $outlet = "";
    public $date = "";
    public $remarks = "";

    public function __construct($oldSalesOrderCart) {
        if($oldSalesOrderCart) {
            $this->items = $oldSalesOrderCart->items;
            $this->totalQty = $oldSalesOrderCart->totalQty;
            $this->outlet = $oldSalesOrderCart->outlet;
            $this->date = $oldSalesOrderCart->date;
            $this->remarks = $oldSalesOrderCart->remarks;
        }
    }

    public function add($item, $id, $quantity, $outlet, $date, $remarks) {
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
            $this->remarks = $remarks;
    }
}