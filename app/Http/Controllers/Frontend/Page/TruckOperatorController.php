<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TruckOperatorController extends Controller
{
    public function index()
    {
        return view('truck-operator');
    }
}
