<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\TruckWeightCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TruckWeightCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.truck-weight.index", [
            "truckWeightCategories" => TruckWeightCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.truck-weight.create");
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
            'name' => "required|string|max:100",
            'weight' => 'required|numeric',
        ]);

        $data = [
            "name" => $request->name,
            "weight" => $request->weight,
        ];

        $truckWeight = new TruckWeightCategory($data);

        if ($truckWeight->save()) {
            Toastr::success("Truck Weight Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckWeightCategory  $truckWeightCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TruckWeightCategory $truckWeightCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckWeightCategory  $truckWeightCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TruckWeightCategory $truckWeightCategory)
    {
        return view("admin.pages.truck-weight.edit", [
            "truckWeightCategory" => $truckWeightCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckWeightCategory  $truckWeightCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TruckWeightCategory $truckWeightCategory)
    {
        $this->validate($request, [
            'name' => "required|string|max:100",
            'weight' => 'required|numeric',
        ]);

        $data = [
            "name" => $request->name,
            "weight" => $request->weight,
        ];
        $truckWeightCategory->fill($data);

        if ($truckWeightCategory->save()) {
            Toastr::success("Truck Weight Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckWeightCategory  $truckWeightCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TruckWeightCategory $truckWeightCategory)
    {
        if ($truckWeightCategory->delete()) {
            Toastr::success("Truck Weight Deleted Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
