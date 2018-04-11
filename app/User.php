<?php

namespace App;
namespace Illuminate\Foundation\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Model;

class User extends model
{
    use Notifiable, Authenticatable;


    public $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone_number','billing_address','shipping_address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wholesaler(){
        return $this->hasOne('App\Wholesaler');
    }
}
