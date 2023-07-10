<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRecommender extends Model
{
    use HasFactory;
    protected $fillable = ['staff_category', 'recommender'];

    public function staffCategory()
    {
        return $this->belongsTo(ManagementCategory::class, 'staff_category');
    }

    public function recommenderCategory()
    {
        return $this->belongsTo(ManagementCategory::class, 'recommender');
    }
}
