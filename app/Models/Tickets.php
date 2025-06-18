<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Department;
use App\Models\Analist;
use core\Enums\Priority;
use core\Enums\Status;
use App\Models\TicketType;
use App\Models\TicketNote;
use App\Models\TransferRequest;

class Tickets extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'departament_id',
        'analyst_id',
        'ticket_type_id',
        'status_id',
        'opening_observation',
        'priority_id',
        'closing_observation',
        'created_by',
        'closed_by',
        'closed_at'
    ];

    protected $casts = [
        'priority_id' => \core\Enums\Priority::class,
        'status_id' => \core\Enums\Status::class,
    ];

    protected static function booted()
    {
        // Observer para atualizar status automaticamente
        static::saving(function ($ticket) {
            $ticket->updateStatusAutomatically();
        });
    }

    /**
     * Atualiza o status automaticamente baseado no contexto
     */
    public function updateStatusAutomatically(): void
    {
        $currentStatus = $this->status_id;

        // Se tem analyst_id, deve estar em ATENDIMENTO
        if ($this->analyst_id && $currentStatus === Status::ABERTO) {
            $this->status_id = Status::ATENDIMENTO;
        }

        // Se não tem analyst_id, deve estar ABERTO
        if (!$this->analyst_id && $currentStatus === Status::ATENDIMENTO) {
            $this->status_id = Status::ABERTO;
        }

        // Se tem closed_at, deve estar FECHADO
        if ($this->closed_at && !in_array($currentStatus, [Status::FECHADO, Status::REJEITADO])) {
            $this->status_id = Status::FECHADO;
        }
    }

    /**
     * Marca o ticket como fechado (concluído)
     */
    public function close(string $observation = null): void
    {
        $this->update([
            'status_id' => Status::FECHADO,
            'closing_observation' => $observation,
            'closed_at' => now(),
        ]);
    }

    /**
     * Marca o ticket como rejeitado (cancelado)
     */
    public function reject(string $observation = null): void
    {
        $this->update([
            'status_id' => Status::REJEITADO,
            'closing_observation' => $observation,
            'closed_at' => now(),
        ]);
    }

    /**
     * Atribui um analista ao ticket
     */
    public function assignAnalyst(int $analystId): void
    {
        $this->update(['analyst_id' => $analystId]);
        // O observer vai automaticamente mudar para ATENDIMENTO
    }

    /**
     * Remove o analista do ticket
     */
    public function unassignAnalyst(): void
    {
        $this->update(['analyst_id' => null]);
        // O observer vai automaticamente mudar para ABERTO
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'departament_id');
    }

    public function analyst()
    {
        return $this->belongsTo(Analist::class, 'analyst_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function closedBy()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

    public function notes()
    {
        return $this->hasMany(TicketNote::class, 'ticket_id');
    }

    public function transferRequest()
    {
        return $this->hasOne(TransferRequest::class, 'ticket_id');
    }

    /**
     * Verifica se o ticket tem uma solicitação de transferência vinculada
     */
    public function hasTransferRequest(): bool
    {
        return $this->transferRequest()->exists();
    }

    /**
     * Retorna os status válidos baseado no contexto do ticket
     */
    public function getValidStatuses(): array
    {
        if ($this->hasTransferRequest()) {
            return Status::getTransferTicketStatuses();
        }

        return Status::getNormalTicketStatuses();
    }
}
