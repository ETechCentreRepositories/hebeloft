<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    // Table Name
    protected $table = 'purchase_order';

    //Timestamps
    public $timestamps = false;
}
