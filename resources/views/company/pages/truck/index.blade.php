@extends('company.layout.master')
@push('style')
    <style>
        .height-30 {
            height: 30px !important;
        }

        .height-40 {
            height: 40px !important;
        }

        .img-rounded {
            border-radius: .375rem;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

    </style>
@endpush
@section('content')
    <div class="bg-white p-20 col-md-10 m-t-30">
        <a class="btn btn-outline-indigo mb-3" href="{{ route('company.truck.create') }}">Add Truck</a>
        <div class="table-responsive">
            <table class="table table-striped m-b-0" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Truck No</th>
                        <th>Category</th>
                        <th>License</th>
                        <th>Image</th>
                        <th>Valid</th>
                        <th width="1%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($company->trucks as $index => $truck)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $truck->truck_no }}</td>
                            <td>
                                {{ $truck->truckCategory->TruckSizeCategory->size . ' Feet, ' . $truck->truckCategory->TruckWeightCategory->weight . ' Ton, ' . $truck->truckCategory->TruckModelCategory->TruckBrandCategory->name . '-' . $truck->truckCategory->TruckModelCategory->model }}
                            </td>
                            <td class="with-img">
                                <img src="{{ asset($truck->license) }}" class="img-rounded height-40">
                            </td>
                            <td class="with-img">
                                <img src="{{ asset($truck->image) }}" class="img-rounded height-40">
                            </td>
                            <td>
                                <span
                                    class="badge badge-{{ truckValid($truck->is_valid)[1] }} text-uppercase">{{ truckValid($truck->is_valid)[0] }}</span>
                            </td>
                            <td class="with-btn" nowrap="">
                                <a href="{{ route('company.truck.edit', $truck->id) }}"
                                    class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger width-60"
                                    onclick="event.preventDefault(); document.getElementById('language{{ $index }}').submit();">
                                    Delete
                                </a>
                                <form id="language{{ $index }}"
                                    action="{{ route('company.truck.destroy', ['truck' => $truck->id]) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
