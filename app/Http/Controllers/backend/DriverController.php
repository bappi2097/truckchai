<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\DriverDetail;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.driver.index', [
            "drivers" => User::role('driver')->with("driver")->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.driver.create');
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
            "email" => "required|email|unique:users,email",
            "mobile_no" => "required|string|max:25",
            "password" => "required|string|min:8|max:25|confirmed",
            "image" => "nullable|file",
            "license" => "nullable|file",
            "nid" => "nullable|file",
            "address" => "required|string",
        ]);
        $user = [
            "name" => $request->name,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
            "password" => bcrypt($request->password),
        ];
        $user = new User($user);
        if ($user->save()) {
            if ($request->hasFile('image')) {
                $image = Storage::disk("local")->put("images\\drivers\\image", $request->image);
            }
            if ($request->hasFile('license')) {
                $license = Storage::disk("local")->put("images\\drivers\\license", $request->license);
            }
            if ($request->hasFile('nid')) {
                $nid = Storage::disk("local")->put("images\\drivers\\nid", $request->nid);
            }
            $userDetails = [
                "uuid" => $user->id + 10000,
                "whatsapp_no" => $request->whatsapp_no,
                "address" => $request->address ?: "",
                "image" => $image ?: "",
                "license" => $license ?: "",
                "nid" => $nid ?: "",
            ];


            if ($user->driver()->save(new DriverDetail($userDetails))) {
                $user->assignRole("driver");
                Toastr::success('Successfully Driver Added', "Success");
            } else {
                $user->delete();
                Toastr::error('Something Went Wrong!', "Error");
            }
        } else {
            Toastr::error('Something Went Wrong!', "Error");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("admin.pages.driver.show", [
            "user" => $user,
            "route" => url()->previous() == route("admin.trucks.index") ? "admin.trucks.index" : "admin.user.driver.index",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.pages.driver.edit', [
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email," . $user->id,
            "mobile_no" => "required|string|max:25",
            "image" => "nullable|file",
            "license" => "nullable|file",
            "nid" => "nullable|file",
            "address" => "required|string",
        ]);
        $userData = [
            "name" => $request->name,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
        ];

        $user->fill($userData);

        if ($user->save()) {
            $userDetails = [
                "address" => $request->address ?: "",
            ];
            if ($request->hasFile('image')) {
                if (Storage::disk("local")->exists($user->driver->image)) {
                    Storage::disk("local")->delete($user->driver->image);
                }
                $userDetails['image'] = Storage::disk("local")->put("images\\drivers\\image", $request->image);
            }

            if ($request->hasFile('license')) {
                if (Storage::disk("local")->exists($user->driver->license)) {
                    Storage::disk("local")->delete($user->driver->license);
                }
                $userDetails['license'] = Storage::disk("local")->put("images\\drivers\\license", $request->license);
            }

            if ($request->hasFile('nid')) {
                if (Storage::disk("local")->exists($user->driver->nid)) {
                    Storage::disk("local")->delete($user->driver->nid);
                }
                $userDetails['nid'] = Storage::disk("local")->put("images\\drivers\\nid", $request->nid);
            }

            if ($user->driver()->update($userDetails)) {
                Toastr::success('Successfully Driver Updated', "Success");
            } else {

                Toastr::error('Something Went Wrong!', "Error");
            }
        } else {

            Toastr::error('Something Went Wrong!', "Error");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Storage::disk("local")->exists($user->driver->image)) {
            Storage::disk("local")->delete($user->driver->image);
        }

        if (Storage::disk("local")->exists($user->driver->license)) {
            Storage::disk("local")->delete($user->driver->license);
        }

        if (Storage::disk("local")->exists($user->driver->nid)) {
            Storage::disk("local")->delete($user->driver->nid);
        }
        if ($user->driver->truck()->exists()) {
            $user->driver->truck()->delete();
        }
        if ($user->driver()->delete() && $user->delete()) {
            Toastr::success('Successfully Driver Deleted', "Success");
        } else {
            Toastr::error('Something Went Wrong!', "Error");
        }
        return redirect()->back();
    }

    /**
     * Change Password of Driver
     * 
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */

    public function changePassword(Request $request, User $user)
    {
        $this->validate($request, [
            "password" => "required|confirmed",
        ]);

        $password = [
            "password" => bcrypt($request->password),
        ];

        $user->fill($password);

        if ($user->save()) {
            Toastr::success('Successfully Password Changed', "Success");
        } else {
            Toastr::error('Something Went Wrong!', "Error");
        }
        return redirect()->back();
    }
}
