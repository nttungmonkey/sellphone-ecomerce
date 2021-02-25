<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ReportController extends Controller
{
    public function orders()
    {
        return view('backend.reports.orders');
    }
    public function ordersData(Request $request)
    {
        $parameter = [
            'fromDay' => $request->fromDay,
            'toNgay' => $request->toDay
        ];
        // // dd($parameter);
        $data = DB::select('
             SELECT bie.bie_created as time
                 , SUM(emd.emd_amount * emd.emd_price) as total
             FROM bill_export bie
             JOIN export_detail emd ON bie.bie_id = emd.bie_id
             WHERE bie.bie_created BETWEEN :fromDay AND :toNgay
             GROUP BY bie.bie_created
            ', $parameter);


        return response()->json(array(
            'code'  => 200,
            'data' => $data,
        ));
    }
}
