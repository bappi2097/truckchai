@extends('driver.layout.master')
@section('content')
<div class="bg-white p-20 col-md-10 m-t-30">
    <div class="bg-white p-20 col-12 m-t-30">
        <form action="{{route('driver.truck.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <div class="form-group">
                    <label for="truck_no">Truck No</label>
                    <input type="text" class="form-control" name="truck_no" id="truck_no" placeholder="">
                    @error('truck_no')
                    <span class="text-red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="brand">Truck Category</label>
                    <select name="truck_category_id" id="truck_category_id" class="form-control selectpicker"
                        style="border: 1px solid #ced4da; border-radius: 0.25rem;" data-live-search="true">
                        <option selected>Choose Category</option>
                        @foreach ($truckCategories as $item)
                        <option value="{{$item->id}}">
                            {{$item->TruckSizeCategory->size . " Feet, " . $item->TruckWeightCategory->weight . " Ton, " . $item->TruckModelCategory->TruckBrandCategory->name . "-" . $item->TruckModelCategory->model}}
                        </option>
                        @endforeach
                    </select>
                    @error('truck_category_id')
                    <span>{{$message}}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img id="user-image" src="{{asset('images/truck-placeholder.png')}}" alt="your image"
                            width="118" height="122" /><br>
                        <input type='file' name="image" id="user-user-btn" style="display: none;"
                            onchange="readURL(this);" accept="user/*" />
                        <input type="button" class="btn btn-outline-secondary" value="Truck Image"
                            onclick="document.getElementById('user-user-btn').click();" />
                    </div>
                    <div class="col-md-6">
                        <img id="license-image"
                            src="@if(!empty($user->driver)) {{asset($user->driver->license ?: 'images/id-card.png')}} @else {{asset('images/id-card.png')}} @endif"
                            alt="your license" width="175" height="100" /><br>
                        <input type='file' name="license" id="user-license-btn" style="display: none;"
                            onchange="readLicenseURL(this);" accept="license/*" />
                        <input type="button" class="btn btn-outline-secondary" value="Update License"
                            style="width: 175px;" onclick="document.getElementById('user-license-btn').click();" />
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary mr-5 my-5">Save</button>
                <a href="{{url()->previous()}}" class="btn btn-sm btn-danger">Cancel</a>
            </fieldset>
        </form>
    </div>
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
    function readLicenseURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#license-image')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(function() {
    $('.selectpicker').selectpicker();
    });
</script>
@endpush