<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $fillable = [
        "company_id", "truck_category_id", "truck_no", "license", "image"
    ];

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, "company_id");
    }

    public function truckCategory()
    {
        return $this->hasOne(TruckCategory::class, "truck_category_id");
    }

    public function driver()
    {
        return $this->belongsTo(DriverDetail::class, "truck_id");
    }
    public function tripBid()
    {
        return $this->belongsToMany(TripBid::class, "truck_id");
    }
}
