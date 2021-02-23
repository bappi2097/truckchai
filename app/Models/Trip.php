<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        "customer_id",
        "truck_category_id",
        "product_id",
        "load_location",
        "unload_location",
        "load_time",
        "status"
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerDetail::class, "customer_id");
    }

    public function truckCategory()
    {
        return $this->belongsTo(TruckCategory::class, "truck_category_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function tripBids()
    {
        return $this->hasMany(TripBid::class, "trip_id");
    }

    public function hasBid(CompanyDetail $companyDetail)
    {
        $trip = $this->tripBids->where("company_id", $companyDetail->id)->first();
        return empty($trip) ? false : $trip->exists();
    }

    public function companyBid(CompanyDetail $companyDetail)
    {
        return $this->hasBid($companyDetail) ? $this->tripBids->where("company_id", $companyDetail->id)->first() : null;
    }
}
