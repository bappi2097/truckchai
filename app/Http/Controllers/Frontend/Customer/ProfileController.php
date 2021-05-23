<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CustomerDetail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view("user.pages.profile", [
            "user" => User::where("id", auth()->user()->id)->with("customer")->first(),
        ]);
    }
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string|max:255",
            "address" => "required|string|max:255",
            "mobile_no" => "required|string|max:100",
            "image" => "nullable|file",
            "email" => "required|email|unique:users,email," . auth()->user()->id,
        ]);


        $user = User::where("id", auth()->user()->id)->with("customer")->first();

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
        ];
        $customerData = [
            "address" => $request->address,
        ];

        $user->fill($data);
        if (empty($user->customer)) {
            if ($request->hasFile('image')) {
                $image = Storage::disk("local")->put("images\\customers", $request->image);
            }
            $customerData["uuid"] = $user->id + 10000;
            $customerData["image"] = $image ?: "";
            $customer = new CustomerDetail($customerData);

            if ($user->save() && $user->customer()->save($customer)) {
                Toastr::success("Profile Updated Successfully", "Success");
            } else {
                Toastr::error("Something Went Wrong", "Error");
            }
        } else {
            if (Storage::disk("local")->exists($user->customer->image)) {
                Storage::disk("local")->delete($user->customer->image);
            }

            $customerData['image'] = Storage::disk("local")->put("images\\customers", $request->image);

            if ($user->save() && $user->customer()->update($customerData)) {
                Toastr::success("Profile Updated Successfully", "Success");
            } else {
                Toastr::error("Something Went Wrong", "Error");
            }
        }

        return redirect()->route('customer.dashboard');
    }

    public function changePassword(Request $request)
    {
        return view("admin");
    }
}
