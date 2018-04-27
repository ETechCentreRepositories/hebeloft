<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecordList extends Model
{
    //Table 
    protected $table = 'sales_record_list';

    //Timestamps
    public $timestamp = false;

    public function salesRecords(){
        return hasMany('\App\Models\SalesRecord');
    }

}
