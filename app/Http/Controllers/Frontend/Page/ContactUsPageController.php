<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsPageController extends Controller
{
    public function index()
    {
        return view('pages.contact-us');
    }
}
