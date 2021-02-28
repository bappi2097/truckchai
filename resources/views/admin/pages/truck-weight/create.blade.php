@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.truck-weight-category.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.truck-weight-category.store')}}" method="POST">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Truck Weight</legend>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Seven and Half Ton">
                @error('name')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="weight">Weight (Ton)</label>
                <input type="number" class="form-control" name="weight" id="weight" placeholder="7.5" min="1" max="60"
                    step="0.05">
                @error('weight')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection