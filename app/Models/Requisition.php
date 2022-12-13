<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'status', 'department_id', 'user_id', 'title', 'total'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function requisition_items(){
        return $this->hasMany(RequisitionItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
