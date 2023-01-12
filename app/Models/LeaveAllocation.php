<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveAllocation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'days', 'year', 'leave_categories_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType() : BelongsTo
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_categories_id');
    }
}
