<?php

namespace core\Enums;

enum TransferStatus: string
{
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Pending = 'pending';
    case Cancelled = 'cancelled';
    case Expired = 'expired';
}
