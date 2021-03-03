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
    public function user()
    {
        return $this->customer->user();
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
        return $this->hasMany(TripBid::class, "trip_id")->with("truck");
    }

    public function hasBid(CompanyDetail $companyDetail)
    {
        $truckIds = $companyDetail->trucks->pluck("id")->all();
        $trip = $this->tripBids->whereIn("truck_id", $truckIds)->first();
        return empty($trip) ? false : $trip->exists();
    }

    public function companyBid(CompanyDetail $companyDetail)
    {
        $truckIds = $companyDetail->trucks->pluck("id")->all();
        return $this->hasBid($companyDetail) ? $this->tripBids->whereIn("truck_id", $truckIds)->first() : null;
    }

    public function hasBidDriver(DriverDetail $driverDetail)
    {
        return !empty($this->driverBid($driverDetail));
    }

    public function driverBid(DriverDetail $driverDetail)
    {
        return $this->tripBids->where("truck_id", $driverDetail->truck->id)->first();
    }

    public function isCanceled()
    {
        return $this->status == 2;
    }

    public function isFinished()
    {
        return $this->status == 3;
    }
    public function approvedBid()
    {
        return $this->tripBids->where("status", 1)->first();
    }
    public function isApprovedBid()
    {
        return !empty($this->approvedBid()) && $this->approvedBid()->exists();
    }

    public function addCustomerNotification(TripBid $trip_bid, $url = "", $text = "")
    {
        if (empty($text)) {
            if ($trip_bid->truck->isDriver()) {
                $text = $trip_bid->truck->driver->user->name . " make bid for Trip<br> Amount: " . $trip_bid->amount;
            } else {
                $text = $trip_bid->truck->company->first()->user . " make bid for Trip<br> Amount: " . $trip_bid->amount;
            }
        }

        return $this->customer->user->notifications()->save(new Notification([
            "trip_id" => $this->id,
            "trip_bid_id" => $trip_bid->id,
            "text" => $text,
            "url" => $url
        ]));
    }
}
