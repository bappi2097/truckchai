<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\AdminDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.admins.index', [
            "admins" => User::role('admin')->where('id', '!=', auth()->id())->with("admin")->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.admins.create');
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
            "whatsapp_no" => "required|string|max:25",
            "password" => "required|string|min:8|max:25|confirmed",
            "image" => "nullable|file",
            "is_super_admin" => "nullable",
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
                $image = Storage::disk("local")->put("images\\admins", $request->image);
            }
            $userDetails = [
                "uuid" => $user->id + 10000,
                "whatsapp_no" => $request->whatsapp_no,
                "address" => $request->address ?: "",
                "image" => $image ?: "",
                "is_super_admin" => $request->is_super_admin ?: 0,
            ];


            if ($user->admin()->save(new AdminDetail($userDetails))) {
                $user->assignRole("admin");
                Toastr::success('Successfully Admin Added', "Success");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.pages.admins.edit', [
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
            "whatsapp_no" => "required|string|max:25",
            "image" => "nullable|file",
            "is_super_admin" => "nullable",
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
                "whatsapp_no" => $request->whatsapp_no,
                "address" => $request->address ?: "",
                "is_super_admin" => $request->is_super_admin ?: 0,
            ];
            if ($request->hasFile('image')) {
                if (Storage::disk("local")->exists($user->admin->image)) {
                    Storage::disk("local")->delete($user->admin->image);
                }
                $userDetails['image'] = Storage::disk("local")->put("images\\admins", $request->image);
            }

            if ($user->admin()->update($userDetails)) {
                $user->assignRole("admin");
                Toastr::success('Successfully Admin Added', "Success");
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
        if (Storage::disk("local")->exists($user->admin->image)) {
            Storage::disk("local")->delete($user->admin->image);
        }
        if ($user->admin()->delete() && $user->delete()) {
            Toastr::success('Successfully Admin Deleted', "Success");
        } else {
            Toastr::error('Something Went Wrong!', "Error");
        }
        return redirect()->back();
    }

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
