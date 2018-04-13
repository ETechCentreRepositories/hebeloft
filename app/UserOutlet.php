<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOutlet extends Model
{
    //Table Name
    protected $table = 'users_has_outlets';

    //Timestamps
    public $timestamp = false;

    public function user(){
        return $this -> belongsTo('\App\User');
    }

    public function outlet(){
        return belongsTo('\App\Outlet');
    }
}
