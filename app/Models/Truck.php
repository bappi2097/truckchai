<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user()
    {
        if ($this->isCompany()) {
            return $this->company->first()->user();
        } elseif ($this->isDriver()) {
            return $this->driver->user();
        }
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
        return !empty($this->driver);
    }
}
