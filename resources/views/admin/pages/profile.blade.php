@extends('admin.layout.app')
@section('title', "Profile | Admin")
@section('content')
<div class="col-md-12 font-size-lg">
    <form action="{{route('admin.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="row justify-center">
                    <div class="mx-auto">
                        <img id="user-image"
                            src="{{asset( empty($admin->admin) && empty($admin->admin->image) ? 'images/admin.png' : $admin->admin->image)}}"
                            alt="your image" width="118" height="122" /><br>
                        <input type='file' name="image" id="user-user-btn" style="display: none;"
                            onchange="readURL(this);" accept="images/*" />
                        <input type="button" class="btn btn-outline-secondary" value="Update Image"
                            style="width: 118px;" onclick="document.getElementById('user-user-btn').click();" />
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$admin->name}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{$admin->email}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile_no">Mobile No</label>
                            <input type="text" name="mobile_no" class="form-control" id="mobile_no"
                                value="{{$admin->mobile_no}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="whatsapp_no">Whats App No</label>
                            <input type="text" name="whatsapp_no" class="form-control" id="whatsapp_no"
                                value="{{!empty($admin->admin) ? $admin->admin->whatsapp_no : ''}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" cols="30" rows="5"
                        class="form-control">{{!empty($admin->admin) ? $admin->admin->address : ''}}</textarea>
                </div>
                <button class="btn btn-primary">Update Profile</button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('script')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#user-image')
                    .attr('src', e.target.result)
                    .width(118)
                    .height(122);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush