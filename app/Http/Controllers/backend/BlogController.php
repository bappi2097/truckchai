<?php

namespace App\Http\Controllers\backend;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.blog.index", [
            "blogs" => Blog::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.blog.create", [
            "blogCategories" => BlogCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required|string|max:500",
            "slug" => "required|string|max:500|unique:blogs,slug",
            "image" => "required|file|mimes:jpg,jpeg,png",
            "description" => "required",
            "blog_category_id" => "required|array",
        ]);
        $data = [
            "title" => $request->title,
            "slug" => $request->slug,
            "image" =>  $request->hasFile('image') ? Storage::disk("local")->put("images\\blogs", $request->image) : "",
            "description" => $request->description,
            "admin_id" => auth()->user()->admin->id,
        ];

        $blog = new Blog($data);

        if ($blog->save()) {
            $blog->blogCategories()->sync($request->blog_category_id);
            Toastr::success("Blog Added Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view("admin.pages.blog.edit", [
            "blog" => $blog,
            "blogCategories" => BlogCategory::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            "title" => "required|string|max:500",
            "slug" => "required|string|max:500|unique:blogs,slug," . $blog->id,
            "image" => "nullable|file|mimes:jpg,jpeg,png",
            "description" => "required",
            "blog_category_id" => "required|array",
        ]);

        $data = [
            "title" => $request->title,
            "slug" => $request->slug,
            "description" => $request->description,
            "admin_id" => auth()->user()->admin->id,
        ];

        if ($request->hasFile('image')) {
            if (Storage::disk("local")->exists($blog->image)) {
                Storage::disk("local")->delete($blog->image);
            }
            $data["image"] = Storage::disk("local")->put("images\\blogs", $request->image);
        }

        $blog->fill($data);

        if ($blog->save()) {
            $blog->blogCategories()->sync($request->blog_category_id);
            Toastr::success("Blog Updated Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->blogCategories()->detach();
        if ($blog->delete()) {
            Toastr::success("Blog Deleted Successfully", "Success");
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }
}
