<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripBid extends Model
{
    use HasFactory;
    protected $fillable = [
        "trip_id",
        "truck_id",
        "company_id",
        "amount",
        "status"
    ];
    // bids belongs to trip
    // bid belongs to one company
    // bid has one truck

    public function trip()
    {
        return $this->belongsTo(Trip::class, "trip_id");
    }

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, "company_id");
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class, "truck_id");
    }
}
