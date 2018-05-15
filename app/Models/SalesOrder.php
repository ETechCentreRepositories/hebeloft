<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    // Table Name
    protected $table = 'sales_order';

    //Timestamps
    public $timestamps = false;

    public function statuses(){
        return $this->belongsTo('App\Models\Status');
    }

    public function products() {
        return $this->belongsTo('App\Models\Products');
    }
}
