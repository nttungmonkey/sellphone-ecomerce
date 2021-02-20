<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Models;
use App\RelatedImage;
use App\Supplier;
use App\Manufacture;
use App\Address;

class ApiController extends Controller
{
    public function getSupplier(Request $request)
    {
        $data = [];
        if($request->has('q'))
        {
            $search = $request->q;
            $data = Supplier::select("sup_id","sup_name")
            		->where('sup_name','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }

    public function getModels(Request $request)
    {
        $data = [];
        if($request->has('q'))
        {
            $search = $request->q;
            $data = Models::select("mod_id","mod_name")
            		->where('mod_name','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }

    public function getManufacture(Request $request)
    {
        $data = [];
        if($request->has('q'))
        {
            $search = $request->q;
            $data = Manufacture::select("mnf_id","mnf_name")
            		->where('mnf_name','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }

    public function getAddress(Request $request)
    {
        $data = [];
        if($request->has('q'))
        {
            $search = $request->q;
            $data = Address::select("adr_id","adr_address")
            		->where('adr_address','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }

    public function getReImg($id)
    {
        $data = [];
        $product = Product::find($id);      
        foreach($product->relatedImage()->get() as $reImg){
            array_push($data, [
                'url'   => asset('storage/images/products/'.$reImg->reimg_name)
            ]);
        }
        return response()->json($data);
        
    }
}
