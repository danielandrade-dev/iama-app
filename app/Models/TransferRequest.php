<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use core\Enums\TransferStatus;

class TransferRequest extends Model
{
    protected $table = 'transfer_requests';

    protected $fillable = [
        'requester_mesu_id',
        'ceding_mesu_id',
        'transfer_type',
        'client_id',
        'status',
        'requester_approval_at',
        'ceding_approval_at',
        'requester_rejection_at',
        'ceding_rejection_at',
        'opening_observation',
        'closing_observation',
        'ticket_id',
    ];

    protected $casts = [
        'transfer_type' => \core\Enums\TransferType::class,
        'status' => TransferStatus::class,
        'requester_approval_at' => 'datetime',
        'ceding_approval_at' => 'datetime',
        'requester_rejection_at' => 'datetime',
        'ceding_rejection_at' => 'datetime',
    ];

    public function requesterMesu()
    {
        return $this->belongsTo(Mesu::class, 'requester_mesu_id');
    }

    public function cedingMesu()
    {
        return $this->belongsTo(Mesu::class, 'ceding_mesu_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'transfer_request_client', 'transfer_request_id', 'client_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }
}
