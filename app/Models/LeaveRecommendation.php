<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRecommendation extends Model
{
    use HasFactory;
    protected $fillable =['user_id', 'leave_application_id', 'comments', 'recommendation'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leave_application()
    {
        return $this->hasOneThrough( LeaveApplication::class, LeaveCategory::class, 'id','leave_categories_id', 'id');
    }
}
