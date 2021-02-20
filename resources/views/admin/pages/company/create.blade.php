@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.user.company.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.user.company.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Company</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
                        @error('name')
                        <span class="text-red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="john.doe@mail.com">
                        @error('email')
                        <span class="text-red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile_no">Mobile No</label>
                        <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                            placeholder="+97XXXXXXXX">
                        @error('mobile_no')
                        <span class="text-red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address"
                            placeholder="24/B Baker Street">
                        @error('address')
                        <span class="text-red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account_name">Account Name</label>
                        <input type="text" class="form-control" name="account_name" id="account_name"
                            placeholder="acme-corporation">
                        @error('account_name')
                        <span class="text-red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="brand">Company Type</label>
                        <select name="company_type_id" id="company_type_id" class="form-control">
                            <option selected>Choose Type</option>
                            @foreach ($companyTypes as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('company_type_id')
                        <span>{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="image">Image (<span class="text-warning">Optional</span>)</label>
                <input type="file" class="form-control" name="image" id="image" accept="images/*">
                @error('image')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="*******">
                        @error('password')
                        <span class="text-red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation" placeholder="*******">
                        @error('password_confirmation')
                        <span class="text-red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection