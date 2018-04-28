<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecord extends Model
{
    //Table 
    protected $table = 'sales_record';

    protected $fillable = [
        'outlets_id','total_price','total_discount', 'remarks',
    ];

    //Timestamps
    public $timestamps = false;

    public function salesRecordLists(){
        return hasMany('\App\Models\SalesRecordList');
    }
}
