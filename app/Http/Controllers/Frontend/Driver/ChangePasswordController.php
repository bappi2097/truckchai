<?php

namespace App\Http\Controllers\Frontend\Driver;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function show(Request $request)
    {
        return view("driver.pages.change-password");
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            "old_password" => "required|string|max:100",
            "password" => "required|string|max:100|confirmed",
        ]);

        $user = User::where("id", auth()->user()->id)->first();

        if (Hash::check($request->old_password, $user->password)) {
            $user->fill(["password" => bcrypt($request->old_password)]);
            if ($user->save()) {
                Toastr::success("Password Changed Successfully", "Success");
            } else {
                Toastr::error("Something went wrong!", "Error");
            }
        } else {
            Toastr::error("Old Password is wrong", "Error");
        }
        return redirect()->back();
    }
}
