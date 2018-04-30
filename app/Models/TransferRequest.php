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
    
}   
