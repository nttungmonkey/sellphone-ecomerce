<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Models;
use App\RelatedImage;
use App\Manufacture;
use App\Supplier;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
use Storage;

class ManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Manufacture::latest()->where('mnf_status', '<>', 0);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn =    '<a href="javascript:void(0)" data-id="'.$row->mnf_id.'" class="btn btn-info btn-sm editManufacture"><i class="fas fa-pencil-alt"></i> Edit</a>                                    
                                    <a href="javascript:void(0)" data-id="'.$row->mnf_id.'" class="btn btn-danger btn-sm deleteManufacture"><i class="fas fa-trash"></i> Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('image', function($row){
                    $url_image = asset('storage/images/manufactures/'.$row->mnf_logo);
                    $image =    '<img src="'.$url_image.'" class="table-avatar" alt="Logo"></img>';
                    return $image;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('backend.manufactures.index');
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
        $manu = new Manufacture();
        $manu->mnf_name = $request->mnf_name;
        $manu->mnf_created = Carbon::now();
        $manu->mnf_updated = Carbon::now();
        $manu->mnf_status = $request->mnf_status;
        if ($files = $request->mnf_logo) {
            $manu->mnf_logo = $files->getClientOriginalName();
            $fileSaved = $files->storeAs('public/images/manufactures/', $manu->mnf_logo);
        }
        $manu->save();
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
        $manu = Manufacture::find($id);
        return response()->json($manu);
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
        $manu = Manufacture::find($id);;
        $manu->mnf_name = $request->mnf_name;
        $manu->mnf_updated = Carbon::now();
        $manu->mnf_status = $request->mnf_status;
        if ($files = $request->mnf_logo) {
            Storage::delete('public/images/manufactures/'.$manu->mnf_logo);
            $manu->mnf_logo = $files->getClientOriginalName();
            $fileSaved = $files->storeAs('public/images/manufactures/', $manu->mnf_logo);
        }
        $manu->save();
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
        $manu = Manufacture::find($id);
        $manu->mnf_status = 0;
        $manu->save();
        return response()->json(['success']);
    }
}
