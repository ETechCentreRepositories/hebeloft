<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table =  'audit_trail';

    protected $fillable = ['action','action_by','created_at','updated_at'];

    public function registers(){
        return $this -> belongsTo('\App\User');
    }
}
