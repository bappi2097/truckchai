<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Language;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;


class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.blog-category.index", [
            "blogCategories"  => BlogCategory::all(),
            "languages" => Language::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.blog-category.create", [
            "languages" => Language::all(),
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
            "name.*" => "required|string",
            "slug" => "required|string",
        ]);

        $data = [
            "slug" => $request->slug,
        ];
        foreach ($request->name as $key => $name) {
            $data["name"][$key] = $name;
        }
        $blogCategory = new BlogCategory($data);
        if ($blogCategory->save()) {
            Toastr::success("Blog Category Successfully added", "Success");
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view("admin.pages.blog-category.edit", [
            "blogCategory" => $blogCategory,
            "languages" => Language::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $this->validate($request, [
            "name.*" => "required|string",
            "slug" => "required|string",
        ]);

        $data = [
            "slug" => $request->slug,
        ];
        foreach ($request->name as $key => $name) {
            $data["name"][$key] = $name;
        }
        $blogCategory->fill($data);
        if ($blogCategory->save()) {
            Toastr::success("Blog Category Successfully updated", "Success");
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        if ($blogCategory->delete()) {
            Toastr::success("Blog Category Successfully Deleted", "Success");
        } else {
            Toastr::error("Something Went Wrong", "Error");
        }
        return redirect()->back();
    }
}
