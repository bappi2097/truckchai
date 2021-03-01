<?php

namespace App\Http\Controllers\Frontend\Driver;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DriverBalanceDetail;

class DashboardController extends Controller
{
    public function index()
    {
        return view('driver.pages.dashboard', [
            "trips" => Trip::where("status", 0)->latest()->get(),
            "balance" => empty(auth()->user()->driver) ? null : DriverBalanceDetail::where("driver_id", auth()->user()->driver->id)->first()
        ]);
    }
}
