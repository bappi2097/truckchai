<?php

namespace App\Http\Controllers\Frontend\Company;

use App\Models\Trip;
use App\Models\User;
use App\Models\Truck;
use App\Models\Product;
use App\Models\CompanyType;
use App\Models\ProductValue;
use Illuminate\Http\Request;
use App\Models\BalanceDetail;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Brian2694\Toastr\Facades\Toastr;

class TripController extends Controller
{
    public function indexCurrent()
    {
        if (empty(auth()->user()->company)) {
            Toastr::warning("First update your profile", "Warning");
            return view("company.pages.profile", [
                "user" => User::where("id", auth()->user()->id)->with("company")->first(),
                "companyTypes" => CompanyType::all(),
            ]);
        }
        $datas = \DB::table("company_detail_truck")
            ->where("company_detail_id", auth()->user()->company->id)
            ->where("trips.status", 1)
            ->join("trucks", "company_detail_truck.truck_id", "trucks.id")
            ->join("trip_bids", "trucks.id", "=", "trip_bids.truck_id")
            ->join("trips", "trip_bids.trip_id", "=", "trips.id")
            ->select(
                "trips.id as id",
                "company_detail_truck.company_detail_id as company_id",
                "trips.load_location as load_location",
                "trips.unload_location as unload_location",
                "trips.load_time as load_time",
                "trips.status as trip_status",
                "trip_bids.status as trip_bid_status"
            )->get();
        return view("company.pages.trip.current-trip", [
            "trips" => $datas
        ]);
    }

    public function indexHistory()
    {
        if (empty(auth()->user()->company)) {
            Toastr::warning("First update your profile", "Warning");
            return view("company.pages.profile", [
                "user" => User::where("id", auth()->user()->id)->with("company")->first(),
                "companyTypes" => CompanyType::all(),
            ]);
        }
        $datas = \DB::table("company_detail_truck")
            ->where("company_detail_id", auth()->user()->company->id)
            ->where("trips.status", 3)
            ->join("trucks", "company_detail_truck.truck_id", "trucks.id")
            ->join("trip_bids", "trucks.id", "=", "trip_bids.truck_id")
            ->join("trips", "trip_bids.trip_id", "=", "trips.id")
            ->select(
                "trips.id as id",
                "company_detail_truck.company_detail_id as company_id",
                "trips.load_location as load_location",
                "trips.unload_location as unload_location",
                "trips.load_time as load_time",
                "trips.status as trip_status",
                "trip_bids.status as trip_bid_status",
                "trucks.id as truck_id",
            )->get();
        $datas = $datas->map(function ($data) {
            $data->truck = Truck::where("id", $data->truck_id)->first();
            return $data;
        });
        return view("company.pages.trip.history-trip", [
            "trips" => $datas
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "load_location" => "required|string",
            "unload_location" => "required|string",
            "load_time" => "required",
            "truck_category_id" => "required",
            "products_description" => "required|string",
            "product_types" => "nullable|array",
            "worker" => "nullable",
        ]);

        $productData = [
            "description" => $request->products_description,
            "worker" => $request->worker ? true : false,
        ];

        $product = new Product($productData);
        if ($product->save()) {
            if (!empty($request->product_types)) {
                foreach ($request->product_types as $key => $productType) {
                    $productValueData = [
                        "product_type_id" => $key
                    ];
                    $product->productValues()->save(new ProductValue($productValueData));
                }
            }
            $tripData = [
                "product_id" => $product->id,
                "company_id" => auth()->user()->company->id,
                "truck_category_id" => $request->truck_category_id,
                "load_location" => $request->load_location,
                "unload_location" => $request->unload_location,
                "load_time" => $request->load_time,
                "status" => 0,
            ];
            $trip = new Trip($tripData);
            if ($trip->save()) {
                Toastr::success("Wow, You make a Trip", "Success");
            } else {
                $product->productValues()->delete();
                $product->delete();
                Toastr::error("Something Went Wrong", "Error");
            }
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }

        return redirect()->back();
    }

    public function showTrip($locale, Trip $trip)
    {
        return view("company.pages.trip.single-trip", [
            "trip" => $trip
        ]);
    }
    public function finish(Request $request, $locale, Trip $trip)
    {
        $company = auth()->user()->company;
        if ($trip->update(["status" => 3])) {
            if (empty($company->balanceDetail)) {
                $balance = new BalanceDetail(["company_id" => $company->id, "balance" => $trip->approvedBid()->amount, "trip_no" => 1]);
                $balance->save();
            } else {
                $company->balanceDetail->increment("trip_no");
                $company->balanceDetail->balance = $company->balanceDetail->balance + $trip->approvedBid()->amount;
                $company->balanceDetail->save();
            }
            $trip->user->notifications()->save(new Notification([
                "trip_id" => $trip->id,
                "text" => "Trip Successfully Finished",
                "url" => route("customer.make-trip.show-trip", $trip->id)
            ]));
            Toastr::success("Trip Successfully Finished", "Success");
        } else {
            Toastr::success("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }
}
