<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\TruckCategory;
use App\Models\TruckSizeCategory;
use App\Models\TruckModelCategory;
use App\Models\TruckWeightCategory;
use App\Http\Controllers\Controller;
use App\Models\TruckCoveredCategory;
use App\Models\TruckTripCategory;
use Brian2694\Toastr\Facades\Toastr;

class TruckCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.truck-category.index", [
            "truckCategories" => TruckCategory::with('truckModelCategory')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.truck-category.create', [
            "truckModelCategories" => TruckModelCategory::all(),
            "truckCoveredCategories" => TruckCoveredCategory::all(),
            "truckSizeCategories" => TruckSizeCategory::all(),
            "truckWeightCategories" => TruckWeightCategory::all(),
            "truckTripCategories" => TruckTripCategory::all(),
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
        // dd($request->all());
        $this->validate($request, [
            'description' => "nullable|string",
            'truck_model_category_id' => "exists:truck_model_categories,id",
            'truck_weight_category_id' => "exists:truck_weight_categories,id",
            'truck_size_category_id' => "exists:truck_size_categories,id",
            'truck_covered_category_id' => "exists:truck_covered_categories,id",
            'truck_trip_category_id' => "required|array",
        ]);

        // dd($request->all());

        $data = [
            "description" => $request->description ?: "",
            "truck_model_category_id" => $request->truck_model_category_id,
            "truck_weight_category_id" => $request->truck_weight_category_id,
            "truck_size_category_id" => $request->truck_size_category_id,
            "truck_covered_category_id" => $request->truck_covered_category_id,
        ];

        $truckCategory = new TruckCategory($data);
        // dd($truckCategory->truckTripCategories());
        // dd($request->truck_trip_category_id);

        if ($truckCategory->save()) {
            $truckCategory->truckTripCategories()->sync($request->truck_trip_category_id);
            Toastr::success("Truck Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckCategory  $truckCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TruckCategory $truckCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckCategory  $truckCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TruckCategory $truckCategory)
    {
        return view('admin.pages.truck-category.edit', [
            "truckCategory" => $truckCategory,
            "truckModelCategories" => TruckModelCategory::all(),
            "truckCoveredCategories" => TruckCoveredCategory::all(),
            "truckSizeCategories" => TruckSizeCategory::all(),
            "truckTripCategories" => TruckTripCategory::all(),
            "truckWeightCategories" => TruckWeightCategory::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckCategory  $truckCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TruckCategory $truckCategory)
    {
        $this->validate($request, [
            'description' => "nullable|string",
            'truck_model_category_id' => "exists:truck_model_categories,id",
            'truck_weight_category_id' => "exists:truck_weight_categories,id",
            'truck_size_category_id' => "exists:truck_size_categories,id",
            'truck_covered_category_id' => "exists:truck_covered_categories,id",
            'truck_trip_category_id' => "required|array",
        ]);

        $data = [
            "description" => $request->description ?: "",
            "truck_model_category_id" => $request->truck_model_category_id,
            "truck_weight_category_id" => $request->truck_weight_category_id,
            "truck_size_category_id" => $request->truck_size_category_id,
            "truck_covered_category_id" => $request->truck_covered_category_id,
        ];

        $truckCategory->fill($data);
        if ($truckCategory->save()) {
            $truckCategory->truckTripCategories()->sync($request->truck_trip_category_id);
            Toastr::success("Truck Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckCategory  $truckCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TruckCategory $truckCategory)
    {
        dd($truckCategory->truckTripCategories());
        if ($truckCategory->delete()) {
            Toastr::success("Truck Deleted Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
