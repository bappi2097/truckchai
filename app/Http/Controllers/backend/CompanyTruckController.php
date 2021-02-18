<?php

namespace App\Http\Controllers\backend;

use App\Models\Truck;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Models\TruckCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class CompanyTruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyDetail $company)
    {
        return view("admin.pages.company-truck.index", [
            "company" => $company
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CompanyDetail $company)
    {
        return view('admin.pages.company-truck.create', [
            "company" =>  $company,
            "truckCategories" => TruckCategory::with(["truckModelCategory", "truckCoveredCategory", "truckSizeCategory", "truckWeightCategory", "truckTripCategories"])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CompanyDetail $company)
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
            $company->trucks()->attach($truck->id);
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
    public function show(Truck $truck, CompanyDetail $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyDetail $company, Truck $truck)
    {
        return view("admin.pages.company-truck.edit", [
            "company" => $company,
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
    public function update(Request $request, CompanyDetail $company, Truck $truck)
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
    public function destroy(CompanyDetail $company, Truck $truck)
    {
        if (Storage::disk("local")->exists($truck->image)) {
            Storage::disk("local")->delete($truck->image);
        }

        if (Storage::disk("local")->exists($truck->license)) {
            Storage::disk("local")->delete($truck->license);
        }

        $company->trucks()->detach($truck->id);

        if ($truck->delete()) {
            Toastr::success('Truck Deleted Successfully', 'Success');
        } else {
            Toastr::error('Something Went Wrong', 'Error');
        }
        return redirect()->back();
    }
}
