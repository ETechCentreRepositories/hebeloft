<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecordList extends Model
{
    //Table 
    protected $table = 'sales_record_list';

    protected $fillable = [
        'products_id','sales_record_id','quantity', 'discount','total',
    ];

    //Timestamps
    public $timestamps = false;

    public function salesRecords(){
        return hasMany('\App\Models\SalesRecord');
    }

}
