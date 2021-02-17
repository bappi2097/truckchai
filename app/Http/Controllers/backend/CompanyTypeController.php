<?php

namespace App\Http\Controllers\backend;

use App\Models\CompanyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CompanyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.company-type.index', [
            'companyTypes' => CompanyType::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.company-type.create');
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
            "name" => "required|string|max:255",
            "description" => "required|string",
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        $companyType = new CompanyType($data);

        if ($companyType->save()) {
            Toastr::success("Successfully Company Type Added", "Success");
        } else {
            Toastr::error("Something Went Worng!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyType $companyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyType $companyType)
    {
        return view('admin.pages.company-type.edit', [
            "companyType" => $companyType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyType $companyType)
    {
        $this->validate($request, [
            "name" => "required|string|max:255",
            "description" => "required|string",
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        $companyType->fill($data);

        if ($companyType->save()) {
            Toastr::success("Successfully Company Type Updated", "Success");
        } else {
            Toastr::error("Something Went Worng!", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyType $companyType)
    {
        if ($companyType->delete()) {
            Toastr::success("Successfully Company Type Deleted", "Success");
        } else {
            Toastr::error("Something Went Worng!", "Error");
        }
        return redirect()->back();
    }
}
