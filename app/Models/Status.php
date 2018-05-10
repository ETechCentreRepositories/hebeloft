<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //Table 
    protected $table = 'status';

    public function salesorders(){
        return $this->belongsToMany('App\Models\SalesOrder');
    }

    public function transferRequests(){
        return $this->belongsToMany('App\Models\TransferRequest');
    }
}
