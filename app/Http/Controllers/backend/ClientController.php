<?php

namespace App\Http\Controllers\backend;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pages.client.index", [
            "clients" => Client::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.client.create");
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
            "name" => "required|string",
        ]);
        $data = [
            "image" => $request->hasFile('image') ? Storage::disk("local")->put("images\\client", $request->image) : "",
            "category" => $request->category,
            "name" => $request->name,
        ];
        $client = new Client($data);
        if ($client->save()) {
            Toastr::success("Client Added Successfully", "Success");
        } else {
            Toastr::error("Something went wrong", "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view("admin.pages.client.edit", [
            "client" => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            "image" => "file|nullable",
            "name" => "required|string",
        ]);
        $data = [
            "category" => $request->category,
            "name" => $request->name,
        ];
        if ($request->hasFile('image')) {
            if (Storage::disk("local")->exists($client->image)) {
                Storage::disk("local")->delete($client->image);
            }
            $data["image"] = Storage::disk("local")->put("images\\client", $request->image);
        }
        $client->fill($data);
        if ($client->save()) {
            Toastr::success("Client Updated Successfully", "Success");
        } else {
            Toastr::error("Something went wrong", "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if (Storage::disk("local")->exists($client->image)) {
            Storage::disk("local")->delete($client->image);
        }
        if ($client->delete()) {
            Toastr::success("Client Deleted Successfully", "Success");
        } else {
            Toastr::error("Something went wrong", "Error");
        }
        return redirect()->back();
    }
}
