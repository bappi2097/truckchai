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
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" />
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a class="mt-2 d-block" href="#">Forget Password</a>
                    <a class="mt-2 d-block" href="{{ route('register') }}">Don't have an account? Create Now</a>
                </form>
            </div>
        </div>
    </div>
@endsection
