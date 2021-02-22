<?php

namespace App\Http\Controllers\Frontend\Company;

use App\Models\User;
use App\Models\Truck;
use App\Models\CompanyType;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Models\TruckCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(auth()->user()->company)) {
            Toastr::warning("First update your profile", "Warning");
            return view("company.pages.profile", [
                "user" => User::where("id", auth()->user()->id)->with("company")->first(),
                "companyTypes" => CompanyType::all(),
            ]);
        }
        return view("company.pages.truck.index", [
            "company" => CompanyDetail::where("id", auth()->user()->company->id)->with("trucks")->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("company.pages.truck.create", [
            "truckCategories" => TruckCategory::with(["truckModelCategory", "truckCoveredCategory", "truckSizeCategory", "truckWeightCategory", "truckTripCategories"])->get(),
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
        if (empty(auth()->user()->company)) {
            Toastr::warning("First update your profile", "Warning");
            return view("company.pages.profile", [
                "user" => User::where("id", auth()->user()->id)->with("company")->first(),
                "companyTypes" => CompanyType::all(),
            ]);
        }
        $company = CompanyDetail::where("id", auth()->user()->company->id)->with("trucks")->first();
        $this->validate($request, [
            "truck_no" => "required|unique:trucks,truck_no",
            "truck_category_id" => "required|exists:truck_categories,id",
            "image" => "required|file",
            "license" => "required|file",
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
            "is_valid" => 0,
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
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, Truck $truck)
    {
        return view("company.pages.truck.edit", [
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
    public function update($locale, Request $request, Truck $truck)
    {
        $this->validate($request, [
            "truck_no" => "required|unique:trucks,truck_no," . $truck->id,
            "truck_category_id" => "required|exists:truck_categories,id",
            "image" => "nullable|file",
            "license" => "nullable|file",
        ]);

        $data = [
            "truck_no" => $request->truck_no,
            "truck_category_id" => $request->truck_category_id,
            "is_valid" => 0,
        ];

        if ($request->hasFile('image')) {
            if (Storage::disk("local")->exists($truck->image)) {
                Storage::disk("local")->delete($truck->image);
            }
            $data['image'] = Storage::disk("local")->put("images\\truck\\image", $request->image);
        }


        if ($request->hasFile('license')) {
            if (Storage::disk("local")->exists($truck->license)) {
                Storage::disk("local")->delete($truck->license);
            }
            $data['license'] = Storage::disk("local")->put("images\\truck\\license", $request->license);
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
    public function destroy($locale, Truck $truck)
    {
        if (Storage::disk("local")->exists($truck->image)) {
            Storage::disk("local")->delete($truck->image);
        }

        if (Storage::disk("local")->exists($truck->license)) {
            Storage::disk("local")->delete($truck->license);
        }

        if ($truck->delete()) {
            Toastr::success('Truck Deleted Successfully', 'Success');
        } else {
            Toastr::error('Something Went Wrong', 'Error');
        }

        return redirect()->back();
    }
}
