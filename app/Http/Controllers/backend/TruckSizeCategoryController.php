<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\TruckSizeCategory;
use Illuminate\Http\Request;

class TruckSizeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.truck-size.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.truck-size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckSizeCategory  $truckSizeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TruckSizeCategory $truckSizeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckSizeCategory  $truckSizeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TruckSizeCategory $truckSizeCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckSizeCategory  $truckSizeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TruckSizeCategory $truckSizeCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckSizeCategory  $truckSizeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TruckSizeCategory $truckSizeCategory)
    {
        //
    }
}
