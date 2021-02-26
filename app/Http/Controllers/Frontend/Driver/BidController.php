<?php

namespace App\Http\Controllers\Frontend\Driver;

use App\Models\TripBid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BidController extends Controller
{
    public function bidApprove(Request $request, $locale, TripBid $tripBid)
    {
        foreach ($tripBid->trip->tripBids->where("id", "!=", $tripBid->id) as $declineTripBid) {
            $declineTripBid->update(["status" => 2]);
        }
        if ($tripBid->update(["status" => 1])) {
            $tripBid->trip->update(["status" => 1]);
            Toastr::success("Wow! Bid Approved", "SUccess");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    public function bidDecline(Request $request, $locale, TripBid $tripBid)
    {
        if ($tripBid->update(["status" => 2])) {
            Toastr::success("Bid Declined", "SUccess");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
