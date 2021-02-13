@extends('admin.layout.app')
@section('content')
<div class="bg-white p-20 col-12 m-t-30">
    <form action="/">
        <fieldset>
            <legend class="m-b-15">Add Truck Size</legend>
            <div class="form-group">
                <label for="exampleInputEmail1">Truck Size in Name</label>
                <input type="text" class="form-control" name="name" placeholder="7 Ton">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <button type="submit" class="btn btn-sm btn-default">Cancel</button>
        </fieldset>
    </form>
</div>
@endsection