<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wholesaler extends Model
{
    //Table Name 
    protected $table = 'wholesalers';

    protected $fillable = [
        'users_id','billing_address','shipping_address',
    ];

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = false;
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
