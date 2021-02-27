<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $fillable = [
        "truck_category_id", "truck_no", "license", "image", "is_valid"
    ];

    public function company()
    {
        return $this->belongsToMany(CompanyDetail::class);
    }

    public function truckCategory()
    {
        return $this->belongsTo(TruckCategory::class);
    }

    public function tripBid()
    {
        return $this->hasMany(TripBid::class, "truck_id");
    }

    public function driver()
    {
        return $this->hasOne(DriverDetail::class, "truck_id");
    }

    public function isCompany()
    {
        return !$this->company->isEmpty();
    }

    public function isDriver()
    {
        return !$this->driver->isEmpty();
    }
}
