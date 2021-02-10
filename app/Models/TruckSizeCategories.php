<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckSizeCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "size"
    ];
    public function truckCategories()
    {
        return $this->hasMany(TruckCategory::class, "truck_size_category_id");
    }
}
