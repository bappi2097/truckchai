<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\TruckSizeCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TruckSizeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.truck-size.index', [
            "truckSizes" => TruckSizeCategory::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.truck-size.create');
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
            'size' => 'required|numeric',
        ]);

        $data = [
            "name" => $request->name,
            "size" => $request->size,
        ];

        $truckSize = new TruckSizeCategory($data);

        if ($truckSize->save()) {
            Toastr::success("Truck Size Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckSizeCategory  $truckSizeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TruckSizeCategory $truckSizeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckSizeCategory  $truckSizeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TruckSizeCategory $truckSizeCategory)
    {
        return view('admin.pages.truck-size.edit', [
            "truckSizeCategory" => $truckSizeCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckSizeCategory  $truckSizeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TruckSizeCategory $truckSizeCategory)
    {
        $this->validate($request, [
            'name' => "required|string|max:100",
            'size' => 'required|numeric',
        ]);

        $data = [
            "name" => $request->name,
            "size" => $request->size,
        ];

        $truckSizeCategory->fill($data);

        if ($truckSizeCategory->save()) {
            Toastr::success("Truck Size Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckSizeCategory  $truckSizeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TruckSizeCategory $truckSizeCategory)
    {
        if ($truckSizeCategory->delete()) {
            Toastr::success("Truck Size Deleted Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
