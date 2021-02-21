@extends('user.layout.master')

@push('style')
<style>
    .h-100 {
        height: 100%;
    }

    .mt-50 {
        margin-top: auto;
    }
</style>
@endpush

@section('content')
<div class="col-md-10">
    @foreach ($trips as $trip)
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded px-5 py-3">
                <div class="card-body">
                    <span
                        class="badge badge-{{tripStatus($trip->status)[1]}} text-uppercase p-2">{{tripStatus($trip->status)[0]}}</span>
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
            </div>
        </div>
    </div>
    @endforeach
    @if ($trips->isEmpty())
    <div class="row justify-content-center h-100">
        <div class="col-md-5 d-flex flex-column  justify-content-center">
            <h4 class="text-purple text-uppercase text-weight-bold text-center">You Don't Have Any Trip Yet.</h4>
            <a href="{{route('customer.dashboard')}}" class="btn btn-outline-indigo text-center">Make a Trip</a>
        </div>
    </div>
    @endif
</div>
@endsection