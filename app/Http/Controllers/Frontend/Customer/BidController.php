<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\TripBid;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function bidApprove(Request $request, $locale, TripBid $tripBid)
    {
        $route = $tripBid->truck->isDriver() ? "driver.trip" : "company.trip";
        foreach ($tripBid->trip->tripBids->where("id", "!=", $tripBid->id) as $declineTripBid) {
            $declineTripBid->update(["status" => 2]);
        }

        if ($tripBid->update(["status" => 1])) {
            $tripBid->trip->update(["status" => 1]);
            $tripBid->approveNotification("", "Approve", route($route . ".show-trip", $tripBid->trip_id));
            Toastr::success("Wow! Bid Approved", "SUccess");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    public function bidDecline(Request $request, $locale, TripBid $tripBid)
    {
        if ($tripBid->update(["status" => 2])) {
            $tripBid->approveNotification("", "Decline");
            Toastr::success("Bid Declined", "SUccess");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
