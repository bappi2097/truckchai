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
        $whyBlogs = BlogCategory::where("slug", "why-choose-traincu")->exists() ? BlogCategory::where("slug", "why-choose-traincu")->first()->blogs()->paginate(3) : null;
        if (!empty($whyBlogs)) {
            $whyBlogs->reject(function ($blog) {
                $blog->created = date("M j", strtotime($blog->created_at));
            });
        }
        $blogs = BlogCategory::where("slug", "!=", "why-choose-traincu")->exists() ? BlogCategory::where("slug", "!=", "why-choose-traincu")->first()->blogs()->paginate(3) : null;
        if (!empty($blogs)) {
            $blogs->reject(function ($blog) {
                $blog->created = date("M j", strtotime($blog->created_at));
            });
        }
        return view('home', [
            "truckCategories" => TruckCategory::with("truckWeightCategory")->latest()->take(12)->get(),
            "sliders" => HeaderSlider::where("category", "home")->orderBy("position")->get(),
            "clients" => Client::latest()->take(12)->get(),
            "whyBlogs" => $whyBlogs,
            "blogs" => $blogs,
        ]);
    }
}
