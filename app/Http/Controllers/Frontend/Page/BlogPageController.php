<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function index()
    {
        return view('blog');
    }

    public function singlePage()
    {
        return view("single-blog");
    }
}
