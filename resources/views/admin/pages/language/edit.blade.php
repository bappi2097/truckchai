@extends('admin.layout.app')
@section('content')
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.language.update', $language->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <fieldset>
            <legend class="m-b-15">Edit Language</legend>
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" class="form-control" name="code" id="code" placeholder="en"
                    value="{{$language->code}}">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="English"
                    value="{{$language->name}}">
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Update</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection