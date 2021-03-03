<?php

namespace App\Http\Controllers\Frontend\Driver;

use App\Models\Trip;
use App\Models\User;
use App\Models\TripBid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BidController extends Controller
{
    public function show($locale, Trip $trip)
    {
        if (empty(auth()->user()->driver)) {
            Toastr::warning("First update your profile", "Warning");
            return view("driver.pages.profile", [
                "user" => User::where("id", auth()->user()->id)->with("driver")->first(),
            ]);
        }
        return view("driver.pages.trip.make-bid", [
            "trip" => $trip,
            "trucks" => auth()->user()->driver->trucks,
        ]);
    }
    public function create($locale, Request $request, Trip $trip)
    {
        $this->validate($request, [
            "amount" => "required",
            "truck_id" => "required|exists:trucks,id",
        ]);

        $data = [
            "truck_id" => $request->truck_id,
            "amount" => $request->amount,
            "status" => 0,
            "trip_id" => $trip->id
        ];

        $tripBid = new TripBid($data);

        if ($tripBid->save()) {
            $trip->addCustomerNotification(
                $tripBid,
                route("customer.make-trip.show-trip", $trip->id),
                $tripBid->truck->driver->user->name . " make bid for Trip<br> Amount: " . $tripBid->amount
            );
            Toastr::success("TripBid Successfully Added", "Success");
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }
}
