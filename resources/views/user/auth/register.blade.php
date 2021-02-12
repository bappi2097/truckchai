@extends('layouts.master')
@section('content')
<div class="container my-5">
    <div class="row login-div">
        <div class="col-md-5 col-sm-12 login-undraw-img">
            <img class="login-undraw-img" src="{{ asset('images/undraw_Login_re_4vu2.svg') }}" alt="" />
        </div>
        <div class="p-5 bg-white rounded shadow-lg col-md-7 col-sm-12 login-form-div text-rtl">
            <form>
                <div class="form-group">
                    <label for="name">{{__('utility.full-name')}}</label>
                    <input type="text" class="form-control" id="name" />
                </div>
                <div class="form-group">
                    <label for="email">{{__('utility.email-address')}}</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" />
                </div>
                <div class="form-group">
                    <label for="user-type">{{__('utility.user-type')}}</label>
                    <select name="user-type" id="user-type" class="form-control">
                        <option value="1">Customer</option>
                        <option value="2">Company</option>
                        <option value="3">Driver</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">{{__('utility.password')}}</label>
                    <input type="password" class="form-control" id="password" />
                </div>
                <div class="form-group">
                    <label for="confirm-password">{{__('utility.confirm-password')}}</label>
                    <input type="password" class="form-control" id="confirm-password" />
                </div>
                <button type="submit" class="btn btn-primary">{{__('utility.register')}}</button>
                <a class="mt-2 d-block" href="{{ route('login') }}">{{__('register.have-an-account')}}</a>
            </form>
        </div>
    </div>
</div>
@endsection