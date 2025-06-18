<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'account',
        'agency',
        'document',
        'mesu_id',
    ];

    public function mesu()
    {
        return $this->belongsTo(Mesu::class, 'mesu_id');
    }

    public function transferRequests()
    {
        return $this->belongsToMany(TransferRequest::class, 'transfer_request_client', 'client_id', 'transfer_request_id');
    }
}
