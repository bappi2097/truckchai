<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Models\HeaderSlider;
use Illuminate\Http\Request;
use App\Models\TruckCategory;
use App\Http\Controllers\Controller;

class TruckOperatorController extends Controller
{
    public function index()
    {
        return view('truck-operator', [
            "truckCategories" => TruckCategory::with("truckWeightCategory")->latest()->take(12)->get(),
            "sliders" => HeaderSlider::where("category", "truck-operator")->get()
        ]);
    }
}
