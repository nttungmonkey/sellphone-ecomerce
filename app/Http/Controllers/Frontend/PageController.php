<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\ContactMailer;
use App\Product;
use DB;

class PageController extends Controller
{
    public function thongke(){
        return view('frontend.thongke');
    }
    //Page index
    public function index()
    { 
        //get data
        $data = DB::select
        (<<<EOT
            select *
            from product AS p, models AS m
            WHERE p.mod_id = m.mod_id and p.pro_status <> 4
            ORDER BY pro_created
            LIMIT 10

            EOT
        );
        

        return view('frontend.index')
                ->with('product', $data);
    }
    //Page login
    public function login()
    { 
        return view('frontend.pages.login');
    }
    //Page home_list
    public function homelist()
    { 
        return view('frontend.pages.home-list');
    }
    //Page wish_list
    public function wishlist()
    { 
        return view('frontend.pages.wish-list');
    }
    //Page contact
    public function contact()
    { 
        return view('frontend.pages.contact');
    }
    //Page email to contact
    public function emailToContact(Request $request)
    {
        if ($request["contactSubject"] == ''){
            $request["contactSubject"] = "Contact";
        } 
        $input = $request->all();
        Mail::to('nttung240197@gmail.com')->send(new ContactMailer($input));
        return $input;
    }
    //Page FAQ
    public function FAQ()
    {
        return view('frontend.pages.faq');
    }
    //Page about
    public function about()
    {
        return view('frontend.pages.about');
    }
    //Page checkout
    public function checkout()
    {
        return view('frontend.pages.checkout');
    }
    //Page cart
    public function cart()
    {
        return view('frontend.pages.shopping-cart');
    }
    //Page single-product
    public function singleProduct(){
        return view('frontend.pages.single-product');
    }
}
