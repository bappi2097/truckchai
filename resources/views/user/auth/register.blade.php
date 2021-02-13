@extends('layouts.master')
@section('content')
<div class="container my-5">
    <div class="row login-div">
        <div class="col-md-5 col-sm-12 login-undraw-img">
            <img class="login-undraw-img" src="{{ asset('images/undraw_Login_re_4vu2.svg') }}" alt="" />
        </div>
        <div class="p-5 bg-white rounded shadow-lg col-md-7 col-sm-12 login-form-div text-rtl">
            <form action="{{route('auth.register')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{__('utility.full-name')}}</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="{{__('utility.john-doe')}}" value="{{old('name')}}" required />
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{__('utility.email-address')}}</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="{{__('utility.john-email')}}" value="{{old('email')}}" aria-describedby="emailHelp"
                        required />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="user-type">{{__('utility.user-type')}}</label>
                    <select name="usertype" id="user-type" class="form-control" required>
                        <option value="1">Customer</option>
                        <option value="2">Company</option>
                        <option value="3">Driver</option>
                    </select>
                    @error('usertype')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{__('utility.password')}}</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="*********"
                        value="{{old('password')}}" required />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm-password">{{__('utility.confirm-password')}}</label>
                    <input type="password" class="form-control" id="confirm-password" name="password_confirmation"
                        value="{{old('password_confirmation')}}" required />
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mobile_no">{{__('utility.mobile')}}</label>
                    <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                        placeholder="{{__('utility.mobile-no')}}" value="{{old('mobile_no')}}" required />
                    @error('mobile_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{__('utility.register')}}</button>
                <a class="mt-2 d-block" href="{{ route('auth.login') }}">{{__('register.have-an-account')}}</a>
            </form>
        </div>
    </div>
</div>
@endsection