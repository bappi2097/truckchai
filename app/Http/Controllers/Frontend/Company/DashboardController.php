<?php

namespace App\Http\Controllers\Frontend\Company;

use App\Models\Trip;
use App\Models\User;
use App\Models\CompanyType;
use Illuminate\Http\Request;
use App\Models\BalanceDetail;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
    {
        if (empty(auth()->user()->company)) {
            Toastr::warning("First update your profile", "Warning");
            return view("company.pages.profile", [
                "user" => User::where("id", auth()->user()->id)->with("company")->first(),
                "companyTypes" => CompanyType::all(),
            ]);
        }
        return view('company.pages.dashboard', [
            "trips" => Trip::where("status", 0)->latest()->get(),
            "balance" => empty(auth()->user()->company) ? null : BalanceDetail::where("company_id", auth()->user()->company->id)->first()
        ]);
    }
}
