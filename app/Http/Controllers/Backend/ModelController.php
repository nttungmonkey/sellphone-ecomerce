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
use App\Exports\ModelExport;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Barryvdh\DomPDF\Facade as PDF;

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
            $data = Models::with('manufacture')->where('mod_status', '<>', 0);
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
        $model->mod_status = 0;
        $model->save();
        return response()->json(['success']);
    }

    public function print()
    {
        $models = Models::all();
        $manufactures = Manufacture::all();
 
        return view('backend.models.print')
            ->with('models', $models)
            ->with('manufactures', $manufactures);
    }

    public function excel() 
    {
        /* Code dành cho việc debug
        - Khi debug cần hiển thị view để xem trước khi Export Excel
        */
        // $ds_sanpham = Sanpham::all();
        // $ds_loai    = Loai::all();
        // return view('backend.sanpham.excel')
        //     ->with('danhsachsanpham', $ds_sanpham)
        //     ->with('danhsachloai', $ds_loai);

        return Excel::download(new ModelExport, 'models.xlsx');
    }

    public function pdf() 
    {
        $models = Models::all();
        $manufactures = Manufacture::all();
        $data = [
            'models' => $models,
            'manufactures'    => $manufactures
        ];

        /* Code dành cho việc debug
        - Khi debug cần hiển thị view để xem trước khi Export PDF
        */
        // return view('backend.products.pdf')
        // ->with('products', $products)
        // ->with('suppliers', $supliers)
        // ->with('models', $models);

        $pdf = PDF::loadView('backend.models.pdf', $data);
        return $pdf->download('models.pdf');
    }
}
