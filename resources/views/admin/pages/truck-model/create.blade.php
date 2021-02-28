@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.truck-model-category.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.truck-model-category.store')}}" method="POST">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Truck Model</legend>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" name="model" id="model" placeholder="407 Gold SFC">
                @error('model')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <select name="truck_brand_category_id" id="brand" class="form-control">
                    <option selected>Choose Brand</option>
                    @foreach ($truckBrandCategories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('truck_brand_category_id')
                <span>{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection