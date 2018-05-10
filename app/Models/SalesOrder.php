<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    // Table Name
    protected $table = 'sales_order';

    //Timestamps
    public $timestamps = false;

    public function status(){
        return $this -> belongsTo('App\Models\Status');
    }
}
