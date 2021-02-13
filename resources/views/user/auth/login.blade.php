@extends('layouts.master')
@section('content')
<div class="container my-5">
    <div class="row login-div">
        <div class="col-md-5 col-sm-12 login-undraw-img">
            <img class="login-undraw-img" src="{{ asset('images/undraw_Login_re_4vu2.svg') }}" alt="" />
        </div>
        <div class="p-5 bg-white rounded shadow-lg col-md-7 col-sm-12 login-form-div text-rtl">
            <form action="{{route('auth.login')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">{{__('utility.email-address')}}</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <small id="emailHelp" class="form-text text-muted">{{__('login.never-share-email')}}</small>
                </div>
                <div class="form-group">
                    <label for="password">{{__('utility.password')}}</label>
                    <input type="password" name="password" class="form-control" id="password" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember-me" name="remember" />
                    <label class="form-check-label" for="remember-me">{{__('utility.remember-me')}}</label>
                </div>
                <button type="submit" class="btn btn-primary">{{__('utility.login')}}</button>
                <a class="mt-2 d-block" href="#">{{__('login.forget-password')}}</a>
                <a class="mt-2 d-block" href="{{ route('auth.register') }}">{{__('login.dont-have-account')}}</a>
            </form>
        </div>
    </div>
</div>
@endsection