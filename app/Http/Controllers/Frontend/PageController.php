<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    //Page index
    public function index()
    { 
        return view('frontend.index');
    }
    //Page home_list
    public function home_list()
    { 
        return view('frontend.pages.home_list');
    }
    //Page wish_list
    public function wish_list()
    { 
        return view('frontend.pages.wish_list');
    }
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
    public function about()
    {
        return view('frontend.pages.about');
    }
}
