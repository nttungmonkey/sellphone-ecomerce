<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'denNgay' => $request->denNgay
        ];
        // // dd($parameter);
        // $data = DB::select('
        //     SELECT dh.dh_thoiGianDatHang as thoiGian
        //         , SUM(ctdh.ctdh_soLuong * ctdh.ctdh_donGia) as tongThanhTien
        //     FROM cusc_donhang dh
        //     JOIN cusc_chitietdonhang ctdh ON dh.dh_ma = ctdh.dh_ma
        //     WHERE dh.dh_thoiGianDatHang BETWEEN :tuNgay AND :denNgay
        //     GROUP BY dh.dh_thoiGianDatHang
        // ', $parameter);
        $data = array(['time' => '10-10-2021', 'total'    => '5'],
                        ['time' => '10-10-2021', 'total'    => '10'],
                        ['time' => '10-10-2022', 'total'    => '15']
        );

        return response()->json(array(
            'code'  => 200,
            'data' => $data,
        ));
    }
}
