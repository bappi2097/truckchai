@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.blog.create')}}" class="btn btn-primary">Add Data</a>
<div class="col-12 mt-3 bg-white rounded p-3">
    <div class="table-responsive">
        <table class="table table-striped m-b-0" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $index => $blog)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$blog->admin->user->name}}</td>
                    <td>{{$blog->title}}</td>
                    <td class="with-img">
                        <img src="{{asset($blog->image)}}" class="img-rounded height-30">
                    </td>
                    <td class="with-btn" nowrap="">
                        <a href="{{route('admin.blog.edit', $blog->id)}}"
                            class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger width-60"
                            onclick="event.preventDefault(); document.getElementById('blog{{ $index }}').submit();">
                            Delete
                        </a>
                        <form id="blog{{ $index }}" action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST"
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