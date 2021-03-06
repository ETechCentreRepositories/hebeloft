<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Notifiable, Authenticatable, CanResetPassword;


    public $table = "users";

    //Timestamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone_number','roles_id','billing_address','shipping_address', 'password','audit_trails_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','roles_id'
    ];

    public function wholesaler(){
        return $this->hasOne('App\Models\Wholesaler');
    }

    public function outlet(){
        return $this->belongsTo('App\Models\Outlet');
    }

    public function roles(){
        return $this->belongsTo('App\Models\Role');
    }

    public function auditTrails(){
        return hasMany('\App\Models\AuditTrail');
    }

    public function users_has_outlets(){
        return $this->belongsTo('\App\Models\UserOutlet');
    }
}
