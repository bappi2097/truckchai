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
            "blogs" => Blog::latest()->paginate(5),
            "blogCategories" => BlogCategory::latest()->get(),
            "latestBlogs" => Blog::latest()->take(5)->get(),
        ]);
    }

    public function singleBlog($locale, $slug)
    {
        return view("single-blog", [
            "blog" => Blog::where("slug", $slug)->first(),
            "blogCategories" => BlogCategory::latest()->get(),
            "latestBlogs" => Blog::latest()->take(5)->get(),
        ]);
    }
    public function blogCategory($locale, $slug)
    {
        $blogCategory = BlogCategory::where("slug", $slug)->with("blogs")->first();

        return view("blog-category", [
            "blogs" => !empty($blogCategory) ? $blogCategory->blogs()->paginate(5) : [],
            "blogCategories" => BlogCategory::latest()->get(),
            "latestBlogs" => Blog::latest()->take(5)->get(),
        ]);
    }
}
