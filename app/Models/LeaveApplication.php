<?php

namespace App\Models;

use App\Enums\LeaveApplicationStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_categories_id',
        'recommend_user_id',
        'phone',
        'email',
        'start_date',
        'end_date',
        'days',
        'status',
        'state',
        'comments',
    ];

    protected $casts = [

        'status' => LeaveApplicationStatusEnum::class

    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leave_category() : BelongsTo
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_categories_id');
    }

}
