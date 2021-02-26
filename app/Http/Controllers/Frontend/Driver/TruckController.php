<?php

namespace App\Http\Controllers\Frontend\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverDetail;
use App\Models\Truck;
use App\Models\TruckCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TruckController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (empty(auth()->user()->driver)) {
            Toastr::warning("Please Complete Your Profile", "Warning");
            return redirect()->route("driver.my-profile.show");
        }
        $truck = auth()->user()->driver->truck;
        if (empty($truck)) {
            return view("driver.pages.truck.create", [
                "truckCategories" => TruckCategory::with(["truckModelCategory", "truckCoveredCategory", "truckSizeCategory", "truckWeightCategory", "truckTripCategories"])->get(),
            ]);
        }
        return view("driver.pages.truck.show", [
            "truck" => $truck
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $locale)
    {
        $this->validate($request, [
            "image" => "required|file",
            "truck_category_id" => "required|exists:truck_categories,id",
            "license" => "required|file",
            "truck_no" => "required|string",
        ]);

        $data = [
            "image" => $request->hasFile('image') ? Storage::disk("local")->put("images\\truck\\image", $request->image) : "",
            "license" => $request->hasFile('license') ? Storage::disk("local")->put("images\\truck\\license", $request->license) : "",
            "truck_category_id" => $request->truck_category_id,
            "truck_no" => $request->truck_no,
            "is_valid" => 0,
        ];
        $driver = DriverDetail::find(auth()->user()->driver->id)->with("truck")->first();
        $truck = new Truck($data);
        if ($truck->save()) {
            $driver->update(["truck_id" => $truck->id]);
            Toastr::success("Truck Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->route("driver.truck.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, Truck $truck)
    {
        return view("driver.pages.truck.edit", [
            "truck" => $truck,
            "truckCategories" => TruckCategory::with(["truckModelCategory", "truckCoveredCategory", "truckSizeCategory", "truckWeightCategory", "truckTripCategories"])->get(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, Truck $truck)
    {
        $this->validate($request, [
            "image" => "nullable|file",
            "truck_category_id" => "required|exists:truck_categories,id",
            "license" => "nullable|file",
            "truck_no" => "required|string",
        ]);

        $data = [
            "truck_category_id" => $request->truck_category_id,
            "truck_no" => $request->truck_no,
            "is_valid" => 0,
        ];

        if ($request->hasFile('image')) {
            if (Storage::disk("local")->exists($truck->image)) {
                Storage::disk("local")->delete($truck->image);
            }
            $data["image"] = Storage::disk("local")->put("images\\truck\\image", $request->image);
        }


        if ($request->hasFile('license')) {
            if (Storage::disk("local")->exists($truck->license)) {
                Storage::disk("local")->delete($truck->license);
            }
            $data["license"] = Storage::disk("local")->put("images\\truck\\license", $request->license);
        }
        $truck->fill($data);
        if ($truck->save()) {
            Toastr::success("Truck Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->route("driver.truck.show");
    }
}
