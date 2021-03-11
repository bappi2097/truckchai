@extends('admin.layout.app')
@section('content')
<a href="{{route($route)}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <fieldset>
        <div class="d-flex">
            <div class="w-25">
                <img width="200"
                    src="{{asset(!empty($user->driver) && !empty($user->driver->image) ? $user->driver->image : 'images/admin.png')}}"
                    alt="">
            </div>
            <div class="w-75">
                <h5 class="mt-4">Full Name: <span class="text-muted">{{$user->name}}</span> </h5>
                <h5 class="mt-4">Email Address: <span class="text-muted">{{$user->email}}</span> </h5>
                <h5 class="mt-4">Mobile No: <span class="text-muted">{{$user->mobile_no}}</span> </h5>
                <h5 class="mt-4">Address: <span
                        class="text-muted">{{$user->driver ? $user->driver->address : "None"}}</span> </h5>
                <h5 class="mt-4">Join Date: <span
                        class="text-muted">{{date("F j, Y, g:i a", strtotime($user->created_at))}}</span> </h5>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mt-4">License</h5>
                        <img width="200"
                            src="{{asset(!empty($user->driver) && !empty($user->driver->license) ? $user->driver->license : 'images/id-card.png')}}">
                    </div>
                    <div class="col-md-6">
                        <h5 class="mt-4">NID</h5>
                        <img width="200"
                            src="{{asset(!empty($user->driver) && !empty($user->driver->nid) ? $user->driver->nid : 'images/id-card.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
@endsection