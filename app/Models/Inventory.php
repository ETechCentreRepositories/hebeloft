<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //Table Name
    protected $table = 'inventory';

    //Timestamps
    public $timestamps = false;

    public function products(){
        return $this -> hasMany('\App\Models\Products');
    }

    // public function outlet(){
    //     return belongsTo('\App\Outlet');
    // }
}
