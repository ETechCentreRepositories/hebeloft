<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderList extends Model
{
    protected $table = 'sales_order_list';

    public $timestamps = false;

    public function products() {
        return $this->belongsTo('App\Models\Products');
    }
}
