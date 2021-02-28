<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\AdminDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view("admin.pages.profile", [
            "admin" => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email," . auth()->user()->id,
            "mobile_no" => "required|string|max:20",
            "whatsapp_no" => "required|string|max:20",
            "image" => "nullable|file",
            "address" => "required|string|max:255",
        ]);

        $user = User::find(auth()->user()->id)->first();

        $userData = [
            "name" => $request->name,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
        ];

        $adminData = [
            "uuid" => $user->id + 10000,
            "user_id" => auth()->user()->id,
            "whatsapp_no" => $request->whatsapp_no,
            "address" => $request->address,
        ];

        $user->fill($userData);

        if ($user->save()) {
            if (empty($user->admin)) {
                $adminData["image"] = $request->hasFile('image') ? Storage::disk("local")->put("images\\admins", $request->image) : "";
                $admin = new AdminDetail($adminData);
                if ($admin->save()) {
                    Toastr::success("Profile Updated Successfully", "Success");
                } else {
                    Toastr::error("Something Went Wrong!", "Error");
                }
            } else {
                if ($request->hasFile('image')) {
                    if (Storage::disk("local")->exists(auth()->user()->admin->image)) {
                        Storage::disk("local")->delete(auth()->user()->admin->image);
                    }
                    $adminData["image"] = Storage::disk("local")->put("images\\admins", $request->image);
                }
                if (auth()->user()->admin()->update($adminData)) {
                    Toastr::success("Profile Updated Successfully", "Success");
                } else {
                    Toastr::error("Something Went Wrong!", "Error");
                }
            }
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
