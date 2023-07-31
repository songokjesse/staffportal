<?php

namespace App\Enums;

enum LeaveApplicationStatusEnum: string
{
    case Pending = 'PENDING';
    case Active = 'ACTIVE';
    case Rejected = 'REJECTED';
    case Ended = 'ENDED';
}
