<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //Table Name
    protected $table = 'products';

    //Timestamps
    public $timestamps = false;

    public function inventory(){
        return $this -> hasmany('\App\Models\Inventory');
    }

    // public function outlet(){
    //     return belongsTo('\App\Outlet');
    // }
}
