<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferRequestList extends Model
{
    protected $table = 'transfer_requests_list';

    public $timestamps = false;

    public function products() {
        return $this->belongsTo('App\Models\Products');
    }
}
