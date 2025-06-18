<?php

namespace core\Enums;

enum Status: int
{
    case ABERTO = 1;
    case ATENDIMENTO = 2;
    case GECT = 3;
    case COCKPIT = 4;
    case REJEITADO = 5;
    case FECHADO = 6;

    /**
     * Status válidos para tickets normais (sem transferência)
     */
    public static function getNormalTicketStatuses(): array
    {
        return [
            self::ABERTO,
            self::ATENDIMENTO,
            self::REJEITADO,
            self::FECHADO,
        ];
    }

    /**
     * Status válidos para tickets com transferência
     */
    public static function getTransferTicketStatuses(): array
    {
        return [
            self::ABERTO,
            self::ATENDIMENTO,
            self::GECT,
            self::COCKPIT,
            self::REJEITADO,
            self::FECHADO,
        ];
    }

    /**
     * Verifica se o status é válido para tickets normais
     */
    public function isValidForNormalTicket(): bool
    {
        return in_array($this, self::getNormalTicketStatuses());
    }

    /**
     * Verifica se o status é válido para tickets com transferência
     */
    public function isValidForTransferTicket(): bool
    {
        return in_array($this, self::getTransferTicketStatuses());
    }

    /**
     * Verifica se o status é específico de transferência (GECT ou COCKPIT)
     */
    public function isTransferSpecific(): bool
    {
        return in_array($this, [self::GECT, self::COCKPIT]);
    }

    /**
     * Status inicial padrão para novos tickets
     */
    public static function getDefaultStatus(): self
    {
        return self::ABERTO;
    }
}
