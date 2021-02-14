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
            SELECT p.*, m.*, id.*, (SUM(id.imd_amount) - SUM(ed.emd_amount)) as sl
            FROM product as p, models as m, import_detail as id, export_detail as ed, bill_import as bi
            WHERE p.mod_id = m.mod_id AND p.pro_id = id.pro_id AND p.pro_id = ed.pro_id AND id.bii_id = bi.bii_id
            GROUP BY p.pro_id
            ORDER BY bi.bii_created DESC
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
