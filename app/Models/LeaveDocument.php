<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDocument extends Model
{
    use HasFactory;
    protected $fillable = ['doc_name', 'file_name', 'leave_application_id'];
}
