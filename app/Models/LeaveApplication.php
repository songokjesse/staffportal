<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_categories_id',
        'start_date',
        'end_date',
        'days',
        'status',
        'comments',
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
