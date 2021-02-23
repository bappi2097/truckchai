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
        "amount",
        "status"
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, "trip_id");
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class, "truck_id");
    }
}
