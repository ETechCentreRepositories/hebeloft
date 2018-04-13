<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    // Table Name
    protected $table = 'outlets';

    //Timestamps
    public $timestamps = false;

    public function user(){
        return $this->hasMany('App\User');
    }
    
}
