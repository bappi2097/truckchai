@extends('company.layout.master')
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
                @if (auth()->user()->company->hasValidTruck())
                @if (!$trip->hasBid(auth()->user()->company))
                <div>
                    <form action="{{route("company.bid.create", $trip->id)}}" method="POST">
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
                                    <select name="truck_id" id="truck_id" class="form-control">
                                        @foreach (auth()->user()->company->validTrucks() as $truck)
                                        <option value="{{$truck->id}}">
                                            {{$truck->truck_no . " (" . $truck->truckCategory->truckModelCategory->model . ")"}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-primary">BID</button>
                        </div>
                    </form>
                </div>
                @else
                <div>
                    @php
                    $bid = $trip->companyBid(auth()->user()->company)->with("truck")->first();
                    @endphp
                    <h5>My BID</h5>
                    <p>Amount: {{$bid->amount}}</p>
                    <p> Truck:
                        {{$bid->truck->truck_no . " (" . $bid->truck->truckCategory->truckModelCategory->model . ")"}}
                    </p>
                </div>
                @endif
                @else
                <h4 class="text-danger text-uppercase">You Don't Have any valid Truck</h4>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection