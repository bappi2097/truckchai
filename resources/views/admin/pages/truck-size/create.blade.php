@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.truck-size-category.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.truck-size-category.store')}}" method="POST">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Truck Size</legend>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Twelve Feet">
                @error('name')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="size">Size (Feet)</label>
                <input type="number" class="form-control" name="size" id="size" placeholder="12" min="1" max="60">
                @error('size')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection