<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ContactUsPageController extends Controller
{
    public function index()
    {
        return view('pages.contact-us');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "name" => "required|string",
            "email" => "required|email",
            "subject" => "required|string",
            "message" => "required|string",
        ]);
        $contact = new Contact($data);
        if ($contact->save()) {
            Toastr::success("Your Mail Successfully Send", "Success");
        } else {
            Toastr::error("Something Went Wrong!", "Error");
        }
        return redirect()->back();
    }
}
