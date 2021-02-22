<?php

namespace App\Http\Controllers\Frontend\Company;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('company.pages.dashboard', [
            "trips" => Trip::where("status", 0)->latest()->get(),
        ]);
    }
}
