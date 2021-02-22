<?php

namespace App\Http\Controllers\Frontend\Company;

use App\Models\Trip;
use App\Models\Truck;
use App\Models\TripBid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BidController extends Controller
{
    public function show($locale, Trip $trip)
    {
        return view("company.pages.trip.make-bid", [
            "trip" => $trip,
            "trucks" => auth()->user()->company->trucks,
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
            "company_id" => auth()->user()->company->id,
            "status" => 0,
            "trip_id" => $trip->id
        ];
        $tripBid = new TripBid($data);
        if ($tripBid->save()) {
            Toastr::success("TripBid Successfully Added", "Success");
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }
}
