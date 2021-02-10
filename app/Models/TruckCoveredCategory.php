<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckCoveredCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
    ];
    public function truckCategories()
    {
        return $this->hasMany(TruckCategory::class, "truck_covered_category_id");
    }
}
