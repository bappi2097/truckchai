<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Truck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TruckCategory;
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
        return view('admin.pages.truck.index', [
            "trucks" => Truck::orderBy("is_valid")->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(User $user, Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        return view("admin.pages.truck.edit", [
            "truck" => $truck,
            "truckCategories" => TruckCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
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
            "is_valid" => 1,
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
    public function destroy(Truck $truck)
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

    public function user(Truck $truck)
    {
        if ($truck->isCompany()) {
            return redirect()->route("admin.user.company.show", $truck->company->first()->user_id);
        } else {
            return redirect()->route("admin.user.driver.show", $truck->driver->user_id);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request, Truck $truck)
    {
        if ($truck->update(["is_valid" => 1])) {
            if ($truck->isCompany()) {
                $truck->user->setNotification($truck->id, "Your Truck Validation Complete : Accepted", route("company.truck.index", "en"));
            } else {
                $truck->user->setNotification($truck->id, "Your Truck Validation Complete : Accepted", route("driver.truck.show", "en"));
            }
            Toastr::success("Truck is valid now", "Success");
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, Truck $truck)
    {
        if ($truck->update(["is_valid" => 2])) {
            if ($truck->isCompany()) {
                $truck->user->setNotification($truck->id, "Your Truck Validation Complete : Rejected", route("company.truck.index", "en"));
            } else {
                $truck->user->setNotification($truck->id, "Your Truck Validation Complete : Rejected", route("driver.truck.show", "en"));
            }
            Toastr::success("Truck is rejected now", "Success");
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }
}
