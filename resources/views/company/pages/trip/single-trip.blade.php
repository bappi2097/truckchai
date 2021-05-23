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
                                class="badge badge-{{ tripStatus($trip->status)[1] }} text-uppercase p-2">{{ tripStatus($trip->status)[0] }}</span>
                        </div>
                        <img class="img-fluid" width="100" src="{{ asset('images/truck.png') }}" alt="">
                        <h6 class="text-weight-bold mt-2">{{ $trip->truckCategory->truckSizeCategory->size }} Feet
                            {{ $trip->truckCategory->truckWeightCategory->weight }} Ton
                            {{ $trip->truckCategory->truckCoveredCategory->name }}</h6>
                        <p class="text-muted">{{ date('F j, Y, g:i a', strtotime($trip->load_time)) }}</p>
                        <div>
                            <span class="d-block">
                                <span class="d-flex align-items-center">
                                    <i class="icon-circle-arrow-up text-primary"></i>
                                    <h5 class="m-0 ml-2">{{ $trip->load_location }}</h5>
                                </span>
                            </span>
                            <span class="seperate-icon"></span>
                            <span class="d-block">
                                <span class="d-flex align-items-center">
                                    <i class="icon-circle-arrow-down text-success"></i>
                                    <h5 class="m-0 ml-2">{{ $trip->unload_location }}</h5>
                                </span>
                            </span>
                        </div>
                        <div class="card px-5 py-2 mt-3">
                            <span>Description: {{ $trip->product->description }}</span>
                        </div>
                        <div class="card px-5 py-2 mt-3">
                            @if (!$trip->product->productValues->isEmpty())
                                @foreach ($trip->product->productValues as $item)
                                    <span>
                                        {{ $item->productTypes->value }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-danger">No product type selected</span>
                            @endif
                        </div>
                    </div>
                    @if (!$trip->isCanceled() && !$trip->isApprovedBid())
                        <div class="d-flex justify-content-center">
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                onclick="event.preventDefault(); document.getElementById('trip{{ $trip->id }}').submit();">
                                Cancel Trip
                            </a>
                            <form id="trip{{ $trip->id }}"
                                action="{{ route('customer.make-trip.cancel', $trip->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if ($trip->isApprovedBid())
            @php
                $tripBid = $trip->approvedBid();
                $tripCompany = $tripBid->truck->company->first();
                $truckCat = $tripBid->truck->truckCategory;
            @endphp
            <div class="row">
                <div class="col-md-12">
                    <div class="card rounded px-5 py-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-sm-12">
                                    <img style="width: 100px; height:100px;" class="rounded"
                                        src="{{ asset($tripCompany->image) }}" alt="">
                                </div>
                                <div class="col-md-10 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5>
                                                        {{ $tripCompany->user->name }}
                                                    </h5>
                                                    <p class="text-muted">
                                                        {{ $truckCat->truckModelCategory->model . ' ' . $truckCat->truckModelCategory->truckBrandCategory->name }}
                                                        <br>
                                                        {{ $truckCat->truckSizeCategory->size . ' Feet ' . $truckCat->truckWeightCategory->weight . ' Ton ' . $truckCat->truckCoveredCategory->name }}
                                                        <br>
                                                        {{ $tripBid->amount . ' TK' }}
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
                    $tripCompany = $tripBid->truck->company->first();
                    $truckCat = $tripBid->truck->truckCategory;
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="card rounded px-5 py-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 col-sm-12">
                                        <img style="width: 100px; height:100px;" class="rounded"
                                            src="{{ asset($tripCompany->image) }}" alt="">
                                    </div>
                                    <div class="col-md-10 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h5>
                                                            {{ $tripCompany->user->name }}
                                                        </h5>
                                                        <p class="text-muted">
                                                            {{ $truckCat->truckModelCategory->model . ' ' . $truckCat->truckModelCategory->truckBrandCategory->name }}
                                                            <br>
                                                            {{ $truckCat->truckSizeCategory->size . ' Feet ' . $truckCat->truckWeightCategory->weight . ' Ton ' . $truckCat->truckCoveredCategory->name }}
                                                            <br>
                                                            {{ $tripBid->amount . ' TK' }}
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
