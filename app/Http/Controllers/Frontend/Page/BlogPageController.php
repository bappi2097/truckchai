<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function index()
    {
        return view('blog', [
            "blogs" => Blog::latest()->get(),
            "blogCategories" => BlogCategory::latest()->get(),
            "latestBlogs" => Blog::latest()->take(5)->get(),
        ]);
    }

    public function singleBlog($locale, $slug)
    {
        return view("single-blog");
    }
    public function singleCategory($locale, $slug)
    {
        return view("single-blog");
    }
}
