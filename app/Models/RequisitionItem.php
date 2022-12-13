<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    use HasFactory;
    protected $fillable = ['item_name', 'item_quantity','unit_cost','total_cost','requisition_id'];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}
