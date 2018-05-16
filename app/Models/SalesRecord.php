<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRecord extends Model
{
    //Table 
    protected $table = 'sales_record';

    //Timestamps
    public $timestamps = false;

    public function salesRecordLists(){
        return $this->hasMany('\App\Models\SalesRecordList');
    }

    public function outlets(){
        return $this->belongsTo('\App\Models\Outlet');
    }
}
