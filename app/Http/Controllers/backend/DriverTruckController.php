<?php

namespace App\Http\Controllers\backend;

use App\Models\Truck;
use App\Models\DriverDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TruckCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class DriverTruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DriverDetail $driver)
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(DriverDetail $driver)
    {
        // dd($driver->truck()->exists());
        if ($driver->truck()->exists()) {
            return view("admin.pages.driver.truck.edit", [
                "driver" => $driver,
                "truck" => $driver->truck,
                "truckCategories" => TruckCategory::with(["truckModelCategory", "truckCoveredCategory", "truckSizeCategory", "truckWeightCategory", "truckTripCategories"])->get(),
            ]);
        } else {
            return view("admin.pages.driver.truck.create", [
                "driver" => $driver,
                "truckCategories" => TruckCategory::with(["truckModelCategory", "truckCoveredCategory", "truckSizeCategory", "truckWeightCategory", "truckTripCategories"])->get(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DriverDetail $driver)
    {
        $this->validate($request, [
            "truck_category_id" => "required|exists:truck_categories,id",
            "truck_no" => "required|string|max:100",
            "license" => "required|file",
            "image" => "required|file",
        ]);


        if ($request->hasFile('image')) {
            $image = Storage::disk("local")->put("images\\truck\\image", $request->image);
        }


        if ($request->hasFile('license')) {
            $license = Storage::disk("local")->put("images\\truck\\license", $request->license);
        }
        $data = [
            "truck_no" => $request->truck_no,
            "license" => $license,
            "image" => $image,
            "truck_category_id" => $request->truck_category_id,
            "is_valid" => 1,
        ];

        $truck = new Truck($data);

        if ($truck->save()) {
            $driver->fill(["truck_id" => $truck->id]);
            $driver->save();
            Toastr::success('Truck Added Successfully', 'Success');
        } else {
            Toastr::error('Something Went Wrong', 'Error');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(DriverDetail $driver, Truck $truck)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(DriverDetail $driver, Truck $truck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DriverDetail $driver, Truck $truck)
    {
        $this->validate($request, [
            "truck_category_id" => "required|exists:truck_categories,id",
            "truck_no" => "required|string|max:100",
            "license" => "nullable|file",
            "image" => "nullable|file",
        ]);

        $data = [
            "truck_no" => $request->truck_no,
            "truck_category_id" => $request->truck_category_id,
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
            Toastr::success('Truck Updated Successfully', 'Success');
        } else {
            Toastr::error('Something Went Wrong', 'Error');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverDetail $driver, Truck $truck)
    {
        //
    }
}
