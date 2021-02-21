<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "truck_weight_category_id", "truck_size_category_id", "truck_covered_category_id", "truck_model_category_id", "description", "image",
    ];

    public function truckModelCategory()
    {
        return $this->belongsTo(TruckModelCategory::class, "truck_model_category_id");
    }
    public function truckCoveredCategory()
    {
        return $this->belongsTo(TruckCoveredCategory::class, "truck_covered_category_id");
    }
    public function truckSizeCategory()
    {
        return $this->belongsTo(TruckSizeCategory::class, "truck_size_category_id");
    }
    public function truckWeightCategory()
    {
        return $this->belongsTo(TruckWeightCategory::class, "truck_weight_category_id");
    }
    public function truckTripCategories()
    {
        return $this->belongsToMany(TruckTripCategory::class);
    }
    public function truck()
    {
        return $this->hasOne(Truck::class);
    }
    public function trip()
    {
        return $this->hasOne(Trip::class, "truck_category_id");
    }
}
