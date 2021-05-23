@extends('company.layout.master')

@section('content')
    <div class="col-md-10">
        @foreach ($trips as $trip)
            <a href="{{ route('company.bid.show', ['trip' => $trip->id]) }}" class="text-decoration-none">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card rounded px-5 py-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <span
                                            class="badge badge-{{ tripStatus($trip->trip_status)[1] }} text-uppercase p-2">{{ tripStatus($trip->trip_status)[0] }}</span>
                                        {{-- <h6 class="text-weight-bold mt-2">{{$trip->truckCategory->truckSizeCategory->size}}
                                Feet
                                {{$trip->truckCategory->truckWeightCategory->weight}} Ton
                                {{$trip->truckCategory->truckCoveredCategory->name}}</h6> --}}
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
                                    </div>
                                    {{-- <div class="col-md-6">
                                <div class="bg-warning text-center float-right" style="width: 50px; height: 50px">
                                    <span>Bid</span><br>
                                    <span class="font-weight-bold">{{$trip->tripBids->count()}}</span>
                        </div>
                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        @if ($trips->isEmpty())
            <div class="row justify-content-center h-100">
                <div class="col-md-5 d-flex flex-column  justify-content-center">
                    <h4 class="text-purple text-uppercase text-weight-bold text-center">You Don't Have Any Bid Yet.</h4>
                </div>
            </div>
        @endif
    </div>
@endsection
