@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.user.admins.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.user.admins.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Admin</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="eamil" class="form-control" name="email" id="email"
                            placeholder="john.doe@mail.com">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile_no">Mobile No</label>
                        <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                            placeholder="+97XXXXXXXX">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="whatsapp_no">WhatsApp No</label>
                        <input type="text" class="form-control" name="whatsapp_no" id="whatsapp_no"
                            placeholder="+97XXXXXXXX">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="image">Image (<span class="text-warning">Optional</span>)</label>
                <input type="file" class="form-control" name="image" id="image" accept="images/*">
            </div>
            <div class="form-group">
                <div class="d-flex align-items-center">
                    <label for="is_super_admin">Super Admin</label>
                    <div class="ml-3 switcher">
                        <input type="checkbox" name="is_super_admin" id="is_super_admin" value="1">
                        <label for="is_super_admin"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="*******">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation" placeholder="*******">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="24/B Baker Street">
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection