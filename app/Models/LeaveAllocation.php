<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAllocation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'days', 'year', 'leave_categories_id'];
}
