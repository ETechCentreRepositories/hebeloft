<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOutlet extends Model
{
    //Table Name
    protected $table = 'users_has_outlets';

    //Timestamps
    public $timestamps = false;

    public function users(){
        return $this -> belongsTo('App\User');
    }

    public function outlet(){
        return $this -> belongsTo('App\Models\Outlet');
    }
}
