<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function whyBlogs()
    {
        $whyBlogs = BlogCategory::where("slug", "why-chose-traincu")->exists() ? BlogCategory::where("slug", "why-chose-traincu")->first()->blogs()->paginate(3) : null;
        $whyBlogs->reject(function ($blog) {
            $blog->description = substr($blog->description, 0, 300);
            $blog->created = date("M j", strtotime($blog->created_at));
        });
        return response()->json($whyBlogs);
    }
    public function latestBlogs()
    {
        $blogs = Blog::latest()->take(3)->get();
        $blogs->reject(function ($blog) {
            $blog->description = substr($blog->description, 0, 300);
            $blog->created = date("M j", strtotime($blog->created_at));
        });
        return response()->json($blogs);
    }
}
