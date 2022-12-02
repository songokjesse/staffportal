<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionComment extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'requisition_id', 'user_id'];
}