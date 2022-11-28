<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requisition extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'status', 'department_id', 'user_id'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
