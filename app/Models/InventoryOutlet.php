<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryOutlet extends Model
{
    protected $table = 'inventory_has_outlets';
    public $timestamps = false;

    public function products(){
        return $this -> belongsTo('App\Models\Products');
    }

    public function outlet(){
        return $this -> belongsTo('App\Models\Outlet');
    }
}
