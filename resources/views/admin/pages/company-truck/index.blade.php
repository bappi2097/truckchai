@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.user.company.truck.create',  $company->id )}}" class="btn btn-primary">Add
    Data</a>
<div class="col-12 mt-3 bg-white rounded p-3">
    <div class="table-responsive">
        <table class="table table-striped m-b-0" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Truck No</th>
                    <th>Category</th>
                    <th>License</th>
                    <th>Image</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($company->trucks as $index => $truck)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{$truck->truck_no}}</td>
                    <td>{{$truck->truck_no}}</td>
                    <td class="with-img">
                        <img src="{{asset($truck->license)}}" class="img-rounded height-30">
                    </td>
                    <td class="with-img">
                        <img src="{{asset($truck->image)}}" class="img-rounded height-30">
                    </td>
                    <td class="with-btn" nowrap="">
                        <a href="{{route('admin.user.company.truck.edit', [
                            "company" => $company->id, "truck" => $truck->id
                        ])}}" class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger width-60"
                            onclick="event.preventDefault(); document.getElementById('language{{ $index }}').submit();">
                            Delete
                        </a>
                        <form id="language{{ $index }}" action="{{ route('admin.user.company.truck.destroy', [
                            "company" => $company->id, "truck" => $truck->id
                        ]) }}" method="POST" style="display: none;">
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