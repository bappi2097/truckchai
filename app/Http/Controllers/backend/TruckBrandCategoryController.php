<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\TruckBrandCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class TruckBrandCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.truck-brand.index', [
            "truckBrandCategories" => TruckBrandCategory::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.truck-brand.create');
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

        $truckBrandCategory = new TruckBrandCategory($data);

        if ($truckBrandCategory->save()) {
            Toastr::success("Truck Brand Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckBrandCategory  $truckBrandCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TruckBrandCategory $truckBrandCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckBrandCategory  $truckBrandCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TruckBrandCategory $truckBrandCategory)
    {
        return view("admin.pages.truck-brand.edit", [
            "truckBrandCategory" => $truckBrandCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckBrandCategory  $truckBrandCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TruckBrandCategory $truckBrandCategory)
    {
        $this->validate($request, [
            'name' => "required|string|max:100",
        ]);

        $data = [
            "name" => $request->name,
        ];
        $truckBrandCategory->fill($data);

        if ($truckBrandCategory->save()) {
            Toastr::success("Truck Brand Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckBrandCategory  $truckBrandCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TruckBrandCategory $truckBrandCategory)
    {
        if ($truckBrandCategory->delete()) {
            Toastr::success("Truck Brand Deleted Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
