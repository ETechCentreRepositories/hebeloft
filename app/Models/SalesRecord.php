<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecord extends Model
{
    //Table 
    protected $table = 'sales_record';

    //Timestamps
    public $timestamp = false;

    public function salesRecordLists(){
        return hasMany('\App\Models\SalesRecordList');
    }
}
