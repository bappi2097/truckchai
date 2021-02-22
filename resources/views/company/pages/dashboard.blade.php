@extends('company.layout.master')

@section('content')
<div class="col-md-10 col-sm-12">
    @foreach ($trips as $trip)
    <a href="{{route('company.bid.show', $trip->id)}}" class="text-decoration-none">
        <div class="row">
            <div class="col-md-12">
                <div class="card rounded px-5 py-3 px-sm-0">
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
    </a>
    @endforeach
</div>
@endsection