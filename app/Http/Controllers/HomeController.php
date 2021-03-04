<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Client;
use App\Models\HeaderSlider;
use Illuminate\Http\Request;
use App\Models\TruckCategory;

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
        return view('home', [
            "truckCategories" => TruckCategory::with("truckWeightCategory")->latest()->take(12)->get(),
            "sliders" => HeaderSlider::where("category", "home")->orderBy("position")->get(),
            "clients" => Client::latest()->take(12)->get()
        ]);
    }

    public function whyBlogs()
    {
        $whyBlogs = BlogCategory::where("slug", "why-choose-traincu")->exists() ? BlogCategory::where("slug", "why-choose-traincu")->first()->blogs()->paginate(3) : null;
        if (!empty($whyBlogs)) {
            $whyBlogs->reject(function ($blog) {
                $blog->summery = substr($blog->summery, 0, 270);
                $blog->created = date("M j", strtotime($blog->created_at));
            });
        }
        return response()->json($whyBlogs);
    }
    public function latestBlogs()
    {
        $blogs = Blog::latest()->take(3)->get();
        if (!empty($blogs)) {
            $blogs->reject(function ($blog) {
                $blog->summery = substr($blog->summery, 0, 270);
                $blog->created = date("M j", strtotime($blog->created_at));
            });
        }
        return response()->json($blogs);
    }
}
