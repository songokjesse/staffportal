<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionAssignment extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'requisition_id', 'department_id'];
}
