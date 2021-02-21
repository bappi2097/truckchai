<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MakeTripController extends Controller
{
    public function store(Request $request)
    {
        // foreach ($request->products as $key => $item) {
        //     dd($key);
        // }
        // dd($request->all());
        $this->validate($request, [
            "load_location" => "required|string",
            "unload_location" => "required|string",
            "load_time" => "required",
            "truck_category_id" => "required",
            "products_description" => "required|string",
            "product_types" => "required|array",
            "worker" => "nullable",
        ]);
        dd($request->all());

        return redirect()->back();
    }
}
