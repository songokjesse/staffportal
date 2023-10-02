<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class LeaveRecommendation extends Model
{
    use HasFactory;
    protected $fillable =['user_id', 'leave_application_id', 'comments', 'recommendation', 'not_recommended', 'recommendation_reminder_sent'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leave_application(): HasOneThrough
    {
        return $this->hasOneThrough( LeaveApplication::class, LeaveCategory::class, 'id','leave_categories_id', 'id');
    }

    public function leaveApplication(){
        return $this->belongsTo(LeaveApplication::class);
    }
}
