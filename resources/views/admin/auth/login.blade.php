@extends('admin.layout.master')
@section('title', "Login | Admin")
@section('app')
    <div id="page-container">

        <div class="login login-v1">

            <div class="login-container">

                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> <b>Color</b> Admin
                        <small>responsive bootstrap 4 admin template</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>


                <div class="login-body">

                    <div class="login-content">
                        <form action="https://seantheme.com/color-admin/admin/html/index.html" method="GET"
                            class="margin-bottom-0">
                            <div class="form-group m-b-20">
                                <input type="text" class="form-control form-control-lg inverse-mode"
                                    placeholder="Email Address" required />
                            </div>
                            <div class="form-group m-b-20">
                                <input type="password" class="form-control form-control-lg inverse-mode"
                                    placeholder="Password" required />
                            </div>
                            <div class="checkbox checkbox-css m-b-20">
                                <input type="checkbox" id="remember_checkbox" />
                                <label for="remember_checkbox">
                                    Remember Me
                                </label>
                            </div>
                            <div class="login-buttons">
                                <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
@endsection
