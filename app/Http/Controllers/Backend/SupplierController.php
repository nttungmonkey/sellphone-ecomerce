<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Models;
use App\RelatedImage;
use App\Supplier;
use App\Address;
use App\Manufacture;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;
use Storage;
use App\Exports\SupplierExport;
use Maatwebsite\Excel\Facades\Excel as Excel;
use Barryvdh\DomPDF\Facade as PDF;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::with('address')->where('sup_status', '<>', 0);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn =    '<a href="javascript:void(0)" data-id="'.$row->sup_id.'" class="btn btn-info btn-sm editSupplier"><i class="fas fa-pencil-alt"></i> Edit</a>                                    
                                    <a href="javascript:void(0)" data-id="'.$row->sup_id.'" class="btn btn-danger btn-sm deleteSupplier"><i class="fas fa-trash"></i> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.suppliers.index');
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
        $supplier = new Supplier();
        $supplier->sup_name = $request->sup_name;
        $supplier->sup_phonenum = $request->sup_phonenum;
        $supplier->sup_email = $request->sup_email;
        $supplier->sup_note = $request->sup_note;
        $supplier->sup_status = $request->sup_status;
        $supplier->sup_created = Carbon::now();
        $supplier->sup_updated = Carbon::now();
        $supplier->adr_id = $request->adr_id;
        $supplier->save();
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
        $supplier = Supplier::find($id); 
        $address = $supplier->address->adr_address;
        return response()->json([$supplier, $address]);
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
        $supplier = Supplier::find($id);
        $supplier->sup_name = $request->sup_name;
        $supplier->sup_phonenum = $request->sup_phonenum;
        $supplier->sup_email = $request->sup_email;
        $supplier->sup_note = $request->sup_note;
        $supplier->sup_status = $request->sup_status;
        $supplier->sup_updated = Carbon::now();
        $supplier->adr_id = $request->adr_id;
        $supplier->save();
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
        $supplier = Supplier::find($id);
        $supplier->sup_status = 0;
        $supplier->save();
        return response()->json(['success']);
    }

    public function print()
    {
        $supliers = Supplier::all();
        $addresses = Address::all();
 
        return view('backend.suppliers.print')
            ->with('suppliers', $supliers)
            ->with('addresses', $addresses);
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

        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }

    public function pdf() 
    {
        $supliers = Supplier::all();
        $addresses = Address::all();
        $data = [
            'suppliers' => $supliers,
            'addresses'    => $addresses
        ];

        /* Code dành cho việc debug
        - Khi debug cần hiển thị view để xem trước khi Export PDF
        */
        // return view('backend.products.pdf')
        // ->with('products', $products)
        // ->with('suppliers', $supliers)
        // ->with('models', $models);

        $pdf = PDF::loadView('backend.suppliers.pdf', $data);
        return $pdf->download('suppliers.pdf');
    }
}
