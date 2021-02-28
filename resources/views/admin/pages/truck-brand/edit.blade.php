@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.truck-brand-category.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.truck-brand-category.update', $truckBrandCategory->id)}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <fieldset>
            <legend class="m-b-15">Edit Truck Brand Category</legend>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Tata"
                    value="{{$truckBrandCategory->name}}">
                @error('name')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Update</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection