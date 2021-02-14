<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckBrandCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        "name"
    ];
    public function truckModelCategories()
    {
        return $this->hasMany(TruckModelCategory::class, "truck_brand_category_id");
    }
}
