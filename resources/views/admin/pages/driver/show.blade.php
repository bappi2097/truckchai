@extends('admin.layout.app')
@section('content')
<a href="{{route($route)}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <fieldset>
        <div class="d-flex">
            <div class="w-25">
                <img width="200" src="{{asset($user->driver->image)}}" alt="">
            </div>
            <div class="w-75">
                <h5 class="mt-4">Full Name: <span class="text-muted">{{$user->name}}</span> </h5>
                <h5 class="mt-4">Email Address: <span class="text-muted">{{$user->email}}</span> </h5>
                <h5 class="mt-4">Mobile No: <span class="text-muted">{{$user->mobile_no}}</span> </h5>
                <h5 class="mt-4">Address: <span class="text-muted">{{$user->driver->address}}</span> </h5>
            </div>
        </div>
    </fieldset>
</div>
@endsection