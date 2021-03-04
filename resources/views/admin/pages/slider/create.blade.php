@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.setting.slider.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.setting.slider.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Slider</legend>
            <div class="form-group">
                <label for="name">Image</label>
                <img id="user-image" style="width: 100%; height: 100%;" src="{{asset('images/1920x700.png')}}"
                    alt="your image" width="118" height="122" /><br>
                <input type='file' name="image" id="user-image-btn" style="display: none;" onchange="readURL(this);"
                    accept="image/*" required />
                <input type="button" class="btn btn-outline-secondary" style="width: 100%;" value="Update Image"
                    onclick="document.getElementById('user-image-btn').click();" />
                @error('image')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="number" class="form-control" name="position" id="position">
                @error('position')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    <option selected>Choose</option>
                    <option value="home">Home</option>
                    <option value="truck-operator">Truck Operator</option>
                </select>
                @error('category')
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