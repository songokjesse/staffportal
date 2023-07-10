<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApprover extends Model
{
    use HasFactory;
    protected $fillable = ['staff_category', 'approver'];


    public function staffCategory()
    {
        return $this->belongsTo(ManagementCategory::class, 'staff_category');
    }

    public function approverCategory()
    {
        return $this->belongsTo(ManagementCategory::class, 'approver');
    }
}
