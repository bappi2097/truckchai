@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.user.company.create')}}" class="btn btn-primary">Add Data</a>
<div class="col-12 mt-3 bg-white rounded p-3">
    <div class="table-responsive">
        <table class="table table-striped m-b-0" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Image</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $index => $company)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$company->company->uuid}}</td>
                    <td>{{$company->name}}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->mobile_no}}</td>
                    <td class="with-img">
                        <img src="{{asset($company->company->image)}}" class="img-rounded height-30">
                    </td>
                    <td class="with-btn" nowrap="">
                        <a href="{{route('admin.user.company.truck.index', $company->company->id)}}"
                            class="btn btn-sm btn-warning width-60 m-r-2">truck</a>
                        <a href="{{route('admin.user.company.edit', $company->id)}}"
                            class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger width-60"
                            onclick="event.preventDefault(); document.getElementById('language{{ $index }}').submit();">
                            Delete
                        </a>
                        <form id="language{{ $index }}" action="{{ route('admin.user.company.destroy', $company->id) }}"
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