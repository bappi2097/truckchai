@extends('admin.layout.master')
@section('title', 'Login | Admin')
@section('app')
<div id="page-container">
    <div class="login login-v1">
        <div class="login-container">
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span>Admin
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <div class="login-body">
                <div class="login-content">
                    <form action="{{route('admin.login')}}" method="POST" class="margin-bottom-0">
                        @csrf
                        <div class="form-group m-b-20">
                            <input type="email" class="form-control form-control-lg inverse-mode" name="email"
                                placeholder="Email Address" required />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group m-b-20">
                            <input type="password" class="form-control form-control-lg inverse-mode" name="password"
                                placeholder="Password" required />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="checkbox checkbox-css m-b-20">
                            <input type="checkbox" id="remember_checkbox" name="remember" />
                            <label for="remember_checkbox">
                                Remember Me
                            </label>
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection