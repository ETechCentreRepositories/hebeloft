<?php

namespace App;

class CartSalesOrder {

    public $items = null;
    public $totalQty = 0;
    public $subTotal = 0;
    public $date = "";
    public $remarks = "";

    public function __construct($oldSalesOrderCart) {
        if($oldSalesOrderCart) {
            $this->items = $oldSalesOrderCart->items;
            $this->totalQty = $oldSalesOrderCart->totalQty;
            $this->subTotal = $oldSalesOrderCart->subTotal;
            $this->date = $oldSalesOrderCart->date;
            $this->remarks = $oldSalesOrderCart->remarks;
        }
    }

    public function add($item, $id, $quantity, $unitPrice, $date, $remarks) {
        $storedItem = ['qty' => 0, 'item' => $item, 'subtotal' => 0];
            if($this->items) {
                if(array_key_exists($id, $this->items)) {
                    $storedItem = $this->items[$id];
                }
            }
            $storedItem['qty'] += $quantity;
            $storedItem['subtotal'] = $quantity*$unitPrice;
            $this->items[$id] = $storedItem;
            $this->totalQty += $quantity;
            $this->date = $date;
            $this->remarks = $remarks;
    }
}