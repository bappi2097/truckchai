<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\TruckBrandCategory;
use App\Models\TruckModelCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class TruckModelCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.truck-model.index', [
            "truckModelCategories" => TruckModelCategory::with('truckBrandCategory')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.truck-model.create', [
            "truckBrandCategories" => TruckBrandCategory::all()
        ]);
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
            'model' => "required|string|max:100",
            'truck_brand_category_id' => "exists:truck_brand_categories,id",
        ]);

        $data = [
            "model" => $request->model,
            "truck_brand_category_id" => $request->truck_brand_category_id,
        ];

        $truckModelCategory = new TruckModelCategory($data);

        if ($truckModelCategory->save()) {
            Toastr::success("Truck Model Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckModelCategory  $truckModelCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TruckModelCategory $truckModelCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckModelCategory  $truckModelCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TruckModelCategory $truckModelCategory)
    {
        return view('admin.pages.truck-model.edit', [
            'truckModelCategory' => $truckModelCategory,
            'truckBrandCategories' => TruckBrandCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckModelCategory  $truckModelCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TruckModelCategory $truckModelCategory)
    {
        $this->validate($request, [
            'model' => "required|string|max:100",
            'truck_brand_category_id' => "exists:truck_brand_categories,id",
        ]);

        $data = [
            "model" => $request->model,
            "truck_brand_category_id" => $request->truck_brand_category_id,
        ];

        $truckModelCategory->fill($data);
        if ($truckModelCategory->save()) {
            Toastr::success("Truck Model Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckModelCategory  $truckModelCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TruckModelCategory $truckModelCategory)
    {
        if ($truckModelCategory->delete()) {
            Toastr::success("Truck Model Deleted Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
