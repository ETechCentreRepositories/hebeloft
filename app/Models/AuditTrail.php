<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table =  'audit_trail';

    protected $fillable = ['id', 'action','action_by','created_at', 'updated_at'];

    public $timestamps = false;

    public function registers(){
        return $this -> belongsTo('\App\User');
    }
}
