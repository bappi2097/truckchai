<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view("user.auth.login");
    }
    public function registerPage()
    {
        return view("user.auth.register");
    }
}
