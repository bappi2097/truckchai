<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckModelCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        "truck_brand_category_id", "model"
    ];
    public function truckBrandCategory()
    {
        return $this->belongsTo(TruckBrandCategory::class, "truck_brand_category_id");
    }
    public function truckCategories()
    {
        return $this->hasMany(TruckCategory::class, "truck_model_category_id");
    }
}
