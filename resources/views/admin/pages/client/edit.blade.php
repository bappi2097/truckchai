@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.setting.client.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.setting.client.update', $client->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <fieldset>
            <legend class="m-b-15">Update Slider</legend>
            <div class="form-group">
                <label for="name">Image</label> <br>
                <img id="user-image" style="width: 300px; height: 300px;" src="{{asset($client->image)}}"
                    alt="your image" width="118" height="122" /><br>
                <input type='file' name="image" id="user-image-btn" style="display: none;" onchange="readURL(this);"
                    accept="image/*" />
                <input type="button" class="btn btn-outline-secondary" style="width: 300px;" value="Update Image"
                    onclick="document.getElementById('user-image-btn').click();" />
                @error('image')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$client->name}}">
                @error('name')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
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
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush