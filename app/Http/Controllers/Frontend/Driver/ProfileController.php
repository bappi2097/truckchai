<?php

namespace App\Http\Controllers\Frontend\Driver;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DriverDetail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view("driver.pages.profile", [
            "user" => User::where("id", auth()->user()->id)->with("driver")->first(),
        ]);
    }
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string|max:255",
            "address" => "required|string|max:255",
            "mobile_no" => "required|string|max:100",
            "image" => "nullable|file",
            "nid" => "nullable|file",
            "license" => "nullable|file",
            "email" => "required|email|unique:users,email," . auth()->user()->id,
        ]);


        $user = User::where("id", auth()->user()->id)->with("driver")->first();

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
        ];
        $driverData = [
            "address" => $request->address,
        ];

        $user->fill($data);
        if (empty($user->driver)) {

            $driverData["image"] = $request->hasFile('image') ? Storage::disk("local")->put("images\\drivers\\image", $request->image) : "";

            $driverData["nid"] = $request->hasFile('nid') ? Storage::disk("local")->put("images\\drivers\\nid", $request->nid) : "";

            $driverData["license"] = $request->hasFile('license') ? Storage::disk("local")->put("images\\drivers\\license", $request->license) : "";

            $driverData["uuid"] = $user->id + 10000;

            $driver = new DriverDetail($driverData);

            if ($user->save() && $user->driver()->save($driver)) {
                Toastr::success("Profile Updated Successfully", "Success");
            } else {
                Toastr::error("Something Went Wrong", "Error");
            }
        } else {

            if ($request->hasFile("image")) {
                if (Storage::disk("local")->exists($user->driver->image)) {
                    Storage::disk("local")->delete($user->driver->image);
                }
                $driverData['image'] = Storage::disk("local")->put("images\\drivers\\image", $request->image);
            }

            if ($request->hasFile("nid")) {
                if (Storage::disk("local")->exists($user->driver->nid)) {
                    Storage::disk("local")->delete($user->driver->nid);
                }
                $driverData['nid'] = Storage::disk("local")->put("images\\drivers\\nid", $request->nid);
            }

            if ($request->hasFile("license")) {
                if (Storage::disk("local")->exists($user->driver->license)) {
                    Storage::disk("local")->delete($user->driver->license);
                }
                $driverData['license'] = Storage::disk("local")->put("images\\drivers\\license", $request->license);
            }

            if ($user->save() && $user->driver()->update($driverData)) {
                Toastr::success("Profile Updated Successfully", "Success");
            } else {
                Toastr::error("Something Went Wrong", "Error");
            }
        }

        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        return view("admin");
    }
}
