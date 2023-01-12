<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCategory extends Model
{
    use HasFactory;
    protected $fillable =['name', 'days'];

    public function leave_allocations()
    {
        return $this->hasMany(LeaveAllocation::class);
    }
}
