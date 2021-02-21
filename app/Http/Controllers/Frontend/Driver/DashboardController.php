<?php

namespace App\Http\Controllers\Frontend\Driver;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Models\TruckCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('driver.pages.dashboard');
    }
}
