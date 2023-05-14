<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignedDuty extends Model
{
    use HasFactory;
    protected $fillable =['user_id', 'leave_application_id', 'comments', 'agree', 'dont_agree'];

    public function leave_application(): BelongsTo
    {
        return $this->belongsTo(LeaveApplication::class);

    }

}
