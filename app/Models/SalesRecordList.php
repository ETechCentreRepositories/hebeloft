<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecordList extends Model
{
    protected $table = 'sales_record_list';

    public $timestamps = false;

    public function products() {
        return $this->belongsTo('App\Models\Products');
    }
}