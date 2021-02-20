@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.language.create')}}" class="btn btn-primary">Add Data</a>
<div class="col-12 mt-3 bg-white rounded p-3">
    <div class="table-responsive">
        <table class="table table-striped m-b-0" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($languages as $index => $language)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$language->code}}</td>
                    <td>{{$language->name}}</td>
                    <td class="with-img">
                        <img src="{{asset($language->logo)}}" class="img-rounded height-30">
                    </td>
                    <td class="with-btn" nowrap="">
                        <a href="{{route('admin.language.edit', $language->id)}}"
                            class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger width-60"
                            onclick="event.preventDefault(); document.getElementById('language{{ $language->code }}').submit();">
                            Delete
                        </a>
                        <form id="language{{ $language->code }}"
                            action="{{ route('admin.language.destroy', $language->id) }}" method="POST"
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