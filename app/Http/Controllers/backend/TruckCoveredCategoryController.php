<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TruckCoveredCategory;
use Brian2694\Toastr\Facades\Toastr;

class TruckCoveredCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.truck-covered.index', [
            "truckCoveredCategories" => TruckCoveredCategory::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.truck-covered.create');
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
        ]);

        $data = [
            "name" => $request->name,
        ];

        $truckCoveredCategory = new TruckCoveredCategory($data);

        if ($truckCoveredCategory->save()) {
            Toastr::success("Truck Covered Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckCoveredCategory  $truckCoveredCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TruckCoveredCategory $truckCoveredCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckCoveredCategory  $truckCoveredCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TruckCoveredCategory $truckCoveredCategory)
    {
        return view("admin.pages.truck-covered.edit", [
            "truckCoveredCategory" => $truckCoveredCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckCoveredCategory  $truckCoveredCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TruckCoveredCategory $truckCoveredCategory)
    {
        $this->validate($request, [
            'name' => "required|string|max:100",
        ]);

        $data = [
            "name" => $request->name,
        ];
        $truckCoveredCategory->fill($data);

        if ($truckCoveredCategory->save()) {
            Toastr::success("Truck Covered Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckCoveredCategory  $truckCoveredCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TruckCoveredCategory $truckCoveredCategory)
    {
        if ($truckCoveredCategory->delete()) {
            Toastr::success("Truck Covered Deleted Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
