<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models;
use App\Manufacture;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
use Storage;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Models::with('manufacture')->select('models.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn =    '<a href="javascript:void(0)" data-id="'.$row->mod_id.'" class="btn btn-info btn-sm editModel"><i class="fas fa-pencil-alt"></i> Edit</a>                                    
                                    <a href="javascript:void(0)" data-id="'.$row->mod_id.'" class="btn btn-danger btn-sm deleteModel"><i class="fas fa-trash"></i> Delete</a>';
                    return $actionBtn;
                })              
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.models.index');
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
        $model = new Models();
        $model->mod_name = $request->mod_name;
        $model->mod_status = $request->mod_status;
        $model->mod_note = $request->mod_note;
        $model->mod_created = Carbon::now();
        $model->mod_updated = Carbon::now();
        $model->mnf_id = $request->mnf_id;
        $model->save();
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
        $model = Models::find($id); 
        $manu = $model->manufacture->mnf_name;
        return response()->json([$model, $manu]);
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
        $model = Models::find($id);
        $model->mod_name = $request->mod_name;
        $model->mod_status = $request->mod_status;
        $model->mod_note = $request->mod_note;
        $model->mod_updated = Carbon::now();
        $model->mnf_id = $request->mnf_id;
        $model->save();
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
        $model = Models::find($id);
        $model->delete();
        return response()->json(['success']);
    }
}
