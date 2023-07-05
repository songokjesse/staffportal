<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManagementStaff extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'department_id', 'management_category_id'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function management_category(): BelongsTo
    {
        return $this->belongsTo(ManagementCategory::class);
    }
}
