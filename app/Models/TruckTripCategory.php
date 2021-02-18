<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckTripCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
    ];

    public function truckCategories()
    {
        return $this->belongsToMany(TruckCategory::class);
    }
}
