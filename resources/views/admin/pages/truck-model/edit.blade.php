@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.truck-model-category.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.truck-model-category.update', $truckModelCategory->id)}}" method="POST">
        @csrf
        @method('PUT')
        <fieldset>
            <legend class="m-b-15">Edit Truck Model</legend>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" name="model" id="model" value="{{$truckModelCategory->model}}"
                    placeholder="407 Gold SFC">
                @error('model')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <select name="truck_brand_category_id" id="brand" class="form-control">
                    @foreach ($truckBrandCategories as $item)
                    <option value="{{$item->id}}" {{selected($item->id, $truckModelCategory->truckBrandCategory->id)}}>
                        {{$item->name}}</option>
                    @endforeach
                </select>
                @error('truck_brand_category_id')
                <span>{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Update</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection