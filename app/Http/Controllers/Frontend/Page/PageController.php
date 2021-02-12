<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function privacyAndPolicy()
    {
        return view('pages.privacy-and-policy');
    }
    public function termsAndCondition()
    {
        return view('pages.terms-and-condition');
    }
    public function faq()
    {
        return view('pages.faq');
    }
}
