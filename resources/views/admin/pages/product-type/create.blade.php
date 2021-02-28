@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.product-type.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.product-type.store')}}" method="POST">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Product Type</legend>
            <div class="form-group">
                <label for="value">Name</label>
                <input type="text" class="form-control" name="value" id="value" placeholder="Living creatures">
                @error('value')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="key">Key</label>
                <input type="text" class="form-control" name="key" id="key" placeholder="living-creatures">
                @error('key')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection