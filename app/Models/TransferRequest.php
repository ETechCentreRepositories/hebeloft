<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferRequest extends Model
{
    // Table Name
    protected $table = 'transfer_requests';

    //Timestamps
    public $timestamps = false;

    // public function user(){
    //     return $this->hasMany('App\User');
    // }

    public function products() {
        return $this->belongsTo('App\Models\Products');
    }

    public function statuses() {
        return $this->belongsTo('App\Models\Status');
    }
    
    public function transferRequestList(){
        return $this -> belongsTo('\App\Models\TransferRequestList');
    }
    
    public function outlets(){
        return $this -> belongsTo('\App\Models\Outlet');
    }
}   
