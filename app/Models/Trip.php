<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasOne(TruckCategory::class, "truck_category_id");
    }
    public function product()
    {
        return $this->hasOne(Product::class, "product_id");
    }
    public function tripBids()
    {
        return $this->hasMany(TripBid::class, "trip_id");
    }
}
