<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('models','supplier')->select('product.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $url_edit = route("admin.products.edit", [$row->pro_id]);
                    $url_delete = route("admin.products.destroy", [$row->pro_id]);
                    $actionBtn =    '<a href="javascript:void(0)" data-id="'.$row->pro_id.'" class="btn btn-info btn-sm editProduct"><i class="fas fa-pencil-alt"></i> Edit</a>                                    
                                    <a href="javascript:void(0)" data-id="'.$row->pro_id.'" class="btn btn-danger btn-sm deleteProduct"><i class="fas fa-trash"></i> Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('image', function($row){
                    $imgs = explode(';',$row->pro_image) ;
                    $url_image = asset('storage/images/products/Model' .$row->mod_id.'/'.$imgs[0].".png");
                    $image =    '<img src="'.$url_image.'" class="table-avatar" alt="Avatar"></img>';
                    return $image;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('backend.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->pro_sku = $request->pro_sku;
        $product->pro_name = $request->pro_name;
        $product->pro_image = $request->pro_image;
        $product->pro_detail = $request->pro_detail;
        $product->pro_status = $request->pro_status;
        $product->pro_descriptS = $request->pro_descriptS;
        $product->pro_descriptF = $request->pro_descriptF;
        $product->pro_created = Carbon::now();
        $product->pro_updated = Carbon::now();
        $product->mod_id = $request->mod_id;
        $product->sup_id = $request->sup_id;
        $product->save();
        return response()->json(['success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->pro_sku = $request->pro_sku;
        $product->pro_name = $request->pro_name;
        $product->pro_image = $request->pro_image;
        $product->pro_detail = $request->pro_detail;
        $product->pro_status = $request->pro_status;
        $product->pro_descriptS = $request->pro_descriptS;
        $product->pro_descriptF = $request->pro_descriptF;
        $product->pro_updated = Carbon::now();
        $product->mod_id = $request->mod_id;
        $product->sup_id = $request->sup_id;
        $product->save();
        return response()->json(['success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json(['success']);
    }
}
