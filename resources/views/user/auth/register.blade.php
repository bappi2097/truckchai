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
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                    </div>
                    <div class="form-group">
                        <label for="user-type">User Type</label>
                        <select name="user-type" id="user-type" class="form-control">
                            <option value="1">Customer</option>
                            <option value="2">Company</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword2" />
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a class="mt-2 d-block" href="{{ route('login') }}">Already have an account? Login</a>
                </form>
            </div>
        </div>
    </div>
@endsection
