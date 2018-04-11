<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wholesaler extends Model
{
    //Table Name 
    protected $table = 'wholesalers';

    protected $fillable = [
        'billing_address','shipping_address', 'company_name',
    ];

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = false;
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
