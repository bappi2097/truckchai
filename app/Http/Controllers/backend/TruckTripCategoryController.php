<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\TruckTripCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TruckTripCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.truck-trip.index", [
            "truckTripCategories" => TruckTripCategory::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.truck-trip.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string|max:100|unique:truck_trip_categories,name",
        ]);

        $data = [
            "name" => $request->name,
        ];

        $truckTripCategory = new TruckTripCategory($data);

        if ($truckTripCategory->save()) {
            Toastr::success("Truck Trip Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckTripCategory  $truckTripCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TruckTripCategory $truckTripCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckTripCategory  $truckTripCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TruckTripCategory $truckTripCategory)
    {
        return view("admin.pages.truck-trip.edit", [
            "truckTripCategory" => $truckTripCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckTripCategory  $truckTripCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TruckTripCategory $truckTripCategory)
    {
        $this->validate($request, [
            "name" => "required|string|max:100|unique:truck_trip_categories,name," . $truckTripCategory->id,
        ]);

        $data = [
            "name" => $request->name,
        ];

        $truckTripCategory->fill($data);

        if ($truckTripCategory->save()) {
            Toastr::success("Truck Trip Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckTripCategory  $truckTripCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TruckTripCategory $truckTripCategory)
    {
        if ($truckTripCategory->delete()) {
            Toastr::success("Truck Trip Deleted Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
