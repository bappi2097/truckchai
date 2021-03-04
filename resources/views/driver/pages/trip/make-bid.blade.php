@extends('driver.layout.master')
@section('content')
<div class="col-md-10">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded px-5 py-3">
                <h4 class="text-uppercase font-weight-bold">Trip</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded px-5 py-3">
                <div class="card-body">
                    <div class="d-block w-100 text-center">
                        <span
                            class="badge badge-{{tripStatus($trip->status)[1]}} text-uppercase p-2">{{tripStatus($trip->status)[0]}}</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-fluid" width="100" src="{{asset('images/truck.png')}}" alt="">
                            <h6 class="text-weight-bold mt-2">{{$trip->truckCategory->truckSizeCategory->size}} Feet
                                {{$trip->truckCategory->truckWeightCategory->weight}} Ton
                                {{$trip->truckCategory->truckCoveredCategory->name}}</h6>
                            <p class="text-muted">{{date("F j, Y, g:i a", strtotime($trip->load_time))}}</p>
                            <div>
                                <span class="d-block">
                                    <span class="d-flex align-items-center">
                                        <i class="icon-circle-arrow-up text-primary"></i>
                                        <h5 class="m-0 ml-2">{{$trip->load_location}}</h5>
                                    </span>
                                </span>
                                <span class="seperate-icon"></span>
                                <span class="d-block">
                                    <span class="d-flex align-items-center">
                                        <i class="icon-circle-arrow-down text-success"></i>
                                        <h5 class="m-0 ml-2">{{$trip->unload_location}}</h5>
                                    </span>
                                </span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <img class="sidebar-user-img" style="width: 80px; height: 80px;"
                                        src="{{asset($trip->customer->image ?: 'images/user2-160x160.jpg')}}" alt="">
                                </div>
                                <div class="col-md-6">
                                    <p>Name: <span>{{$trip->customer->user->name}}</span></p>
                                    <p>Mobile No: <span>{{$trip->customer->user->mobile_no}}</span></p>
                                    <p>Email: <span>{{$trip->customer->user->email}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card px-5 py-2 mt-3">
                        <span>{{$trip->product->description}}</span>
                    </div>
                    <div class="card px-5 py-2 mt-3">
                        @foreach ($trip->product->productValues as $item)
                        <span>
                            {{$item->productTypes->value}}
                        </span>
                        @endforeach
                    </div>
                </div>
                @if (auth()->user()->driver->hasValidTruck())
                @if (!$trip->hasBidDriver(auth()->user()->driver))
                <div>
                    <form action="{{route("driver.bid.create", $trip->id)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control" min="1"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="truck_id">Truck</label>
                                    @php
                                    $truck = auth()->user()->driver->validTruck();
                                    @endphp
                                    <input type="hidden" name="truck_id" value="{{$truck->id}}">
                                    <input type="text" id="truck_id" class="form-control"
                                        value="{{$truck->truck_no . ' (' . $truck->truckCategory->truckModelCategory->model . ')'}}">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-primary">BID</button>
                        </div>
                    </form>
                </div>
                @else
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card  p-3">
                            @php
                            $bid = $trip->driverBid(auth()->user()->driver);
                            @endphp
                            <h5>My BID</h5>
                            <p>Amount: {{$bid->amount}}</p>
                            <p> Truck:
                                {{$bid->truck->truck_no . " (" . $bid->truck->truckCategory->truckModelCategory->model . ")"}}
                            </p>
                        </div>
                    </div>
                </div>
                @if (!$trip->isFinished() && $bid->isApproved())
                <div>
                    <a href="javascript:void(0)" class="btn btn-sm btn-success float-right"
                        onclick="event.preventDefault(); document.getElementById('trip{{ $trip->id }}').submit();">
                        Finish Trip
                    </a>
                    <form id="trip{{ $trip->id }}" action="{{ route('driver.trip.finish', $trip->id) }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
                @endif
                @endif
                @else
                <h4 class="text-danger text-uppercase">You Don't Have any valid Truck</h4>
                @endif
            </div>
        </div>
    </div>
    @if ($trip->isApprovedBid() && !empty($trip->approvedBid()->truck->driver))
    @php
    $tripBid = $trip->approvedBid();
    if($tripBid->truck->isCompany()){
    $tripUser= !empty($trip->approvedBid()->truck->driver) ? $tripBid->truck->driver->first() : null;
    }else{
    $tripUser= $tripBid->truck->driver;
    }
    $truckCat = $tripBid->truck->truckCategory;
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded px-5 py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <img style="width: 100px; height:100px;" class="rounded" src="{{asset($tripUser->image)}}"
                                alt="">
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h5>
                                                {{$tripUser->user->name}}
                                            </h5>
                                            <p class="text-muted">
                                                {{$truckCat->truckModelCategory->model . " " . $truckCat->truckModelCategory->truckBrandCategory->name}}
                                                <br>
                                                {{$truckCat->truckSizeCategory->size . " Feet " . $truckCat->truckWeightCategory->weight . " Ton " . $truckCat->truckCoveredCategory->name}}
                                                <br>
                                                {{$tripBid->amount . " TK"}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div>
                                        <span class="badge badge-success">Bid Apporved</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    @foreach ($trip->tripBids as $tripBid)
    @php
    if($tripBid->truck->isCompany()){
    $tripUser= !empty($trip->approvedBid()->truck->company) ? $tripBid->truck->company->first() : null;
    }else{
    $tripUser= $tripBid->truck->driver;
    }
    $truckCat = $tripBid->truck->truckCategory;
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded px-5 py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <img style="width: 100px; height:100px;" class="rounded" src="{{asset($tripUser->image)}}"
                                alt="">
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h5>
                                                {{$tripUser->user->name}}
                                            </h5>
                                            <p class="text-muted">
                                                {{$truckCat->truckModelCategory->model . " " . $truckCat->truckModelCategory->truckBrandCategory->name}}
                                                <br>
                                                {{$truckCat->truckSizeCategory->size . " Feet " . $truckCat->truckWeightCategory->weight . " Ton " . $truckCat->truckCoveredCategory->name}}
                                                <br>
                                                {{$tripBid->amount . " TK"}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    @if ($tripBid->isApproved())
                                    <div>
                                        <span class="badge badge-success">Bid Apporved</span>
                                    </div>
                                    @endif

                                    @if ($tripBid->isDeclined())
                                    <div>
                                        <span class="badge badge-danger">Bid Declined</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection