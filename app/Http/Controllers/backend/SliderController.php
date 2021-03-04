<?php

namespace App\Http\Controllers\backend;

use App\Models\HeaderSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.slider.index", [
            "sliders" => HeaderSlider::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.slider.create");
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
            "image" => "file|required",
            "category" => "required|string|in:home,truck-operator",
            "position" => "required|numeric",
        ]);
        $data = [
            "image" => $request->hasFile('image') ? Storage::disk("local")->put("images\\slider", $request->image) : "",
            "category" => $request->category,
            "position" => $request->position,
        ];
        $slider = new HeaderSlider($data);
        if ($slider->save()) {
            Toastr::success("Slider Added Successfully", "Success");
        } else {
            Toastr::error("Something went wrong", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HeaderSlider  $headerSlider
     * @return \Illuminate\Http\Response
     */
    public function show(HeaderSlider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeaderSlider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(HeaderSlider $slider)
    {
        return view("admin.pages.slider.edit", [
            "slider" => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HeaderSlider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeaderSlider $slider)
    {
        $this->validate($request, [
            "image" => "file|nullable",
            "category" => "required|string|in:home,truck-operator",
            "position" => "required|numeric",
        ]);
        $data = [
            "category" => $request->category,
            "position" => $request->position,
        ];
        if ($request->hasFile('image')) {
            if (Storage::disk("local")->exists($slider->image)) {
                Storage::disk("local")->delete($slider->image);
            }
            $data["image"] = Storage::disk("local")->put("images\\slider", $request->image);
        }
        $slider->fill($data);
        if ($slider->save()) {
            Toastr::success("Slider Updated Successfully", "Success");
        } else {
            Toastr::error("Something went wrong", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeaderSlider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeaderSlider $slider)
    {
        if (Storage::disk("local")->exists($slider->image)) {
            Storage::disk("local")->delete($slider->image);
        }
        if ($slider->delete()) {
            Toastr::success("Slider Deleted Successfully", "Success");
        } else {
            Toastr::error("Something went wrong", "Error");
        }
        return redirect()->back();
    }
}
