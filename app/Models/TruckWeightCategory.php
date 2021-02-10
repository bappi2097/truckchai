<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckWeightCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "weight"
    ];
    public function truckCategories()
    {
        return $this->hasMany(TruckCategory::class, "truck_weight_category_id");
    }
}
