<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductValue;
use App\Models\Trip;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MakeTripController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "load_location" => "required|string",
            "unload_location" => "required|string",
            "load_time" => "required",
            "truck_category_id" => "required",
            "products_description" => "required|string",
            "product_types" => "required|array",
            "worker" => "nullable",
        ]);

        $productData = [
            "description" => $request->products_description,
            "worker" => $request->worker ? true : false,
        ];

        $product = new Product($productData);
        if ($product->save()) {
            foreach ($request->product_types as $key => $productType) {
                $productValueData = [
                    "product_type_id" => $key
                ];
                $product->productValues()->save(new ProductValue($productValueData));
            }
            $tripData = [
                "product_id" => $product->id,
                "customer_id" => auth()->user()->customer->id,
                "truck_category_id" => $request->truck_category_id,
                "load_location" => $request->load_location,
                "unload_location" => $request->unload_location,
                "load_time" => $request->load_time,
                "status" => 0,
            ];
            $trip = new Trip($tripData);
            if ($trip->save()) {
                Toastr::success("Wow, You make a Trip", "Success");
            } else {
                $product->productValues()->delete();
                $product->delete();
                Toastr::error("Something Went Wrong", "Error");
            }
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }

        return redirect()->back();
    }
}
