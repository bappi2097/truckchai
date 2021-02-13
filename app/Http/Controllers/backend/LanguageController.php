<?php

namespace App\Http\Controllers\backend;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.language.index', [
            "languages" => \App\Models\Language::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.language.create');
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
            "code" => ['required', 'string'],
            "name" => ['required', 'string'],
            "logo" => ['required', 'file'],
        ]);

        if ($request->hasFile('logo')) {
            $logo = Storage::disk("local")->put("images\\flag", $request->logo);
        }

        $data = [
            "code" => $request->code,
            "name" => $request->name,
            "logo" => $logo,
        ];

        $language = new Language($data);
        if ($language->save()) {
            Toastr::success('Language Added Successfully', 'Success');
        } else {
            Toastr::error('Something Went Wrong', 'Error');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        return view('admin.pages.language.edit', [
            "language" => $language
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $this->validate($request, [
            "code" => ['required', 'string'],
            "name" => ['required', 'string'],
            "logo" => ['nullable', 'file'],
        ]);
        $data = [
            "code" => $request->code,
            "name" => $request->name,
        ];

        if ($request->hasFile('logo')) {
            if (Storage::disk("local")->exists($language->logo)) {
                Storage::disk("local")->delete($language->logo);
            }
            $data["logo"] = Storage::disk("local")->put("images\\flag", $request->logo);
        }
        $language->fill($data);
        if ($language->save()) {
            Toastr::success('Language Updated Successfully', 'Success');
        } else {
            Toastr::error('Something Went Wrong', 'Error');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        if (Storage::disk("local")->exists($language->logo)) {
            Storage::disk("local")->delete($language->logo);
        }
        if ($language->delete()) {
            Toastr::success('Language Deleted Successfully', 'Success');
        } else {
            Toastr::error('Something Went Wrong', 'Error');
        }
        return redirect()->back();
    }
}
