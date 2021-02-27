<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id", "uuid", "address", "image", "nid", "license", "truck_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class, "truck_id");
    }
    /**
     * Get the user's testimonial.
     */

    public function testimonial()
    {
        return $this->morphOne(Testimonial::class, 'testimonialable');
    }
    public function driverBalanceDetail()
    {
        return $this->hasOne(DriverBalanceDetail::class, "driver_id");
    }
    public function validTruck()
    {
        return $this->hasValidTruck() ? $this->truck : null;
    }

    public function hasTruck()
    {
        return !empty($this->truck);
    }

    public function hasValidTruck()
    {
        return $this->hasTruck() ? $this->truck->is_valid == 1 : false;
    }

    public function tripBids()
    {
        return $this->hasMany(TripBid::class);
    }
}
