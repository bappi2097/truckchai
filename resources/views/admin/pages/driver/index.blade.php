@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.user.driver.create')}}" class="btn btn-primary">Add Data</a>
<div class="col-12 mt-3 bg-white rounded p-3">
    <div class="table-responsive">
        <table class="table table-striped m-b-0" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Driver ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Image</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($drivers as $index => $driver)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$driver->driver->uuid}}</td>
                    <td>{{$driver->name}}</td>
                    <td>{{$driver->email}}</td>
                    <td>{{$driver->mobile_no}}</td>
                    <td class="with-img">
                        <img src="{{asset($driver->driver->image)}}" class="img-rounded height-30">
                    </td>
                    <td class="with-btn" nowrap="">
                        <a href="{{route('admin.user.driver.truck.create', $driver->driver->id)}}"
                            class="btn btn-sm btn-warning width-60 m-r-2">Truck</a>
                        <a href="{{route('admin.user.driver.show', $driver->id)}}"
                            class="btn btn-sm btn-success width-60 m-r-2">View</a>
                        <a href="{{route('admin.user.driver.edit', $driver->id)}}"
                            class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger width-60"
                            onclick="event.preventDefault(); document.getElementById('language{{ $index }}').submit();">
                            Delete
                        </a>
                        <form id="language{{ $index }}" action="{{ route('admin.user.driver.destroy', $driver->id) }}"
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
@push('script')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
        } );
</script>
@endpush