@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.truck-trip-category.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.truck-trip-category.update', $truckTripCategory->id)}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <fieldset>
            <legend class="m-b-15">Edit Truck Trip Category</legend>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Seven and Half Ton"
                    value="{{$truckTripCategory->name}}">
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Update</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection