<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    //Page contact
    public function contact()
    { 
        return view('frontend.pages.contact');
    }
    //Page email to contact
    public function email_to_contact()
    {
        return view('frontend.pages.email_to_contact');
    }
    //Page FAQ
    public function FAQ()
    {
        return view('frontend.pages.faq');
    }
}
