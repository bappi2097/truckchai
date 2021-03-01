@extends('admin.layout.app')
@section('content')
<div class="col-12 mt-3 bg-white rounded p-3">
    <div class="table-responsive">
        <table class="table table-striped m-b-0" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Truck No</th>
                    <th>User Type</th>
                    <th>Category</th>
                    <th>License</th>
                    <th>Image</th>
                    <th>Valid</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trucks as $index => $truck)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{$truck->truck_no}}</td>
                    @if ($truck->isCompany())
                    <td>Company</td>
                    @else
                    <td>Driver</td>
                    @endif
                    <td>
                        {{$truck->truckCategory->TruckSizeCategory->size . " Feet, " . $truck->truckCategory->TruckWeightCategory->weight . " Ton, " . $truck->truckCategory->TruckModelCategory->TruckBrandCategory->name . "-" . $truck->truckCategory->TruckModelCategory->model}}
                    </td>
                    <td class="with-img">
                        <img src="{{asset($truck->license)}}" class="img-rounded height-40">
                    </td>
                    <td class="with-img">
                        <img src="{{asset($truck->image)}}" class="img-rounded height-40">
                    </td>
                    <td>
                        <span
                            class="badge badge-{{truckValid($truck->is_valid)[1]}} text-uppercase">{{truckValid($truck->is_valid)[0]}}</span>
                    </td>
                    <td class="with-btn" nowrap="">
                        @if ($truck->is_valid != 1)
                        <a href="javascript:void(0)" class="btn btn-sm btn-success width-60"
                            onclick="event.preventDefault(); document.getElementById('accept{{ $index }}').submit();">
                            <i class="fas fa-lg fa-fw m-r-10 fa-check"></i>
                        </a>
                        <form id="accept{{ $index }}"
                            action="{{ route('admin.trucks.accept', [ "truck" => $truck->id ]) }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        @endif
                        @if ($truck->is_valid != 2)
                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary width-60"
                            onclick="event.preventDefault(); document.getElementById('reject{{ $index }}').submit();">
                            <i class="fas fa-lg fa-fw m-r-10 fa-times"></i>
                        </a>
                        <form id="reject{{ $index }}"
                            action="{{ route('admin.trucks.reject', [ "truck" => $truck->id ]) }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        @endif
                        <a href="{{route('admin.trucks.user', $truck->id)}}"
                            class="btn btn-sm btn-light width-60 m-r-2">
                            <i class="fas fa-lg fa-fw m-r-10 fa-user"></i>
                        </a>
                        <a href="{{route('admin.trucks.edit', $truck->id)}}"
                            class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger width-60"
                            onclick="event.preventDefault(); document.getElementById('language{{ $index }}').submit();">
                            Delete
                        </a>
                        <form id="language{{ $index }}"
                            action="{{ route('admin.trucks.destroy', [ "truck" => $truck->id ]) }}" method="POST"
                            style="display: none;">
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
@push('script')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
        } );
</script>
@endpush