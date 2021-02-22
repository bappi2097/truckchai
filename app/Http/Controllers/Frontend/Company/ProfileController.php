<?php

namespace App\Http\Controllers\Frontend\company;

use App\Models\User;
use App\Models\CompanyType;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view("company.pages.profile", [
            "user" => User::where("id", auth()->user()->id)->with("company")->first(),
            "companyTypes" => CompanyType::all(),
        ]);
    }
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string|max:255",
            "account_name" => "required|string|max:255|unique:company_details,account_name" . (empty(auth()->user()->company) ? "" : "," . auth()->user()->company->id),
            "address" => "required|string|max:255",
            "mobile_no" => "required|string|max:100",
            "image" => "nullable|file",
            "email" => "required|email|unique:users,email," . auth()->user()->id,
            "company_type_id" => "required",
        ]);


        $user = User::where("id", auth()->user()->id)->with("company")->first();

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
        ];
        $companyData = [
            "address" => $request->address,
            "company_type_id" => $request->company_type_id,
            "account_name" => $request->account_name,
        ];

        $user->fill($data);
        if (empty($user->company)) {
            if ($request->hasFile('image')) {
                $image = Storage::disk("local")->put("images\\company", $request->image);
            }
            $companyData["uuid"] = $user->id + 10000;
            $companyData["image"] = $image ?: "";
            $company = new CompanyDetail($companyData);

            if ($user->save() && $user->company()->save($company)) {
                Toastr::success("Profile Updated Successfully", "Success");
            } else {
                Toastr::error("Something Went Wrong", "Error");
            }
        } else {
            if ($request->hasFile('image')) {
                if (Storage::disk("local")->exists($user->company->image)) {
                    Storage::disk("local")->delete($user->company->image);
                }
                $companyData['image'] = Storage::disk("local")->put("images\\company", $request->image);
            }

            if ($user->save() && $user->company()->update($companyData)) {
                Toastr::success("Profile Updated Successfully", "Success");
            } else {
                Toastr::error("Something Went Wrong", "Error");
            }
        }

        return redirect()->back();
    }
}
