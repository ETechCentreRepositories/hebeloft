<?php

namespace App;

class CartSalesOrder {

    public $items = null;
    public $totalQty = 0;
    public $date = "";
    public $remarks = "";
    public $counter = 000;

    public function __construct($oldSalesOrderCart) {
        if($oldSalesOrderCart) {
            $this->items = $oldSalesOrderCart->items;
            $this->totalQty = $oldSalesOrderCart->totalQty;
            $this->date = $oldSalesOrderCart->date;
            $this->remarks = $oldSalesOrderCart->remarks;
        }
    }

    public function add($item, $id, $quantity, $unitPrice, $date, $remarks) {
        $storedItems = ['qty' => 0, 'item' => $item, 'unitPrice' => $unitPrice];
            if($this->items) {
                if(array_key_exists($id, $this->items)) {
                    $storedItems = $this->items[$id];
                }
            }

            $storedItems['qty'] += $quantity;
            $this->items[$id] = $storedItems;
            $this->totalQty += $quantity;
            $this->date = $date;
            $this->remarks = $remarks;
    }
}