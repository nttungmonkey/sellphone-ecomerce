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
        $spMoi = DB::select
        (<<<EOT
            SELECT  *
            FROM view_products as v
            ORDER BY v.bii_updated desc
            limit 10

            EOT
        );

        $spBanChay = DB::select
        (<<<EOT
            SELECT * 
            FROM view_products v, view_slsanpham sl
            WHERE v.pro_id = sl.pro_id
            ORDER BY sl.slXuat desc
            LIMIT 10
            EOT
        );

        $spre = DB::select
        (<<<EOT
            SELECT *
            FROM view_products v
            ORDER BY imd_priceExp
            LIMIT 10
            EOT
        );

        $spViVo = DB::select
        (<<<EOT
            SELECT *
            FROM view_products v
            WHERE v.mnf_name='vivo'
            ORDER BY RAND()
            LIMIT 3
            EOT
        );
        $spSamSung = DB::select
        (<<<EOT
            SELECT *
            FROM view_products v
            WHERE v.mnf_name='samsung'
            ORDER BY RAND()
            LIMIT 3

            EOT
        );
        $spOppo = DB::select
        (<<<EOT
            SELECT *
            FROM view_products v
            WHERE v.mnf_name='oppo'
            ORDER BY RAND()
            LIMIT 3

            EOT
        );

        //random sp21 - sp30
        //random img 7 - 12
        $imgShow = DB::select
        (<<<EOT
            SELECT vp.*, ri.reimg_name
            FROM view_products vp, related_image ri
            WHERE vp.pro_id = ri.pro_id AND
            (ri.reimg_name LIKE '%-7.png' OR
            ri.reimg_name LIKE '%-8.png' OR
            ri.reimg_name LIKE '%-9.png' OR
            ri.reimg_name LIKE '%-10.png' OR
            ri.reimg_name LIKE '%-11.png' OR
            ri.reimg_name LIKE '%-12.png') 
            ORDER BY RAND()
            EOT
        );

        return view('frontend.index')
                ->with('product', $spMoi)
                ->with('bestsell', $spBanChay)
                ->with('bestcheap', $spre)
                ->with('spVivo', $spViVo)
                ->with('spSamsung', $spSamSung)
                ->with('spOppo', $spOppo)
                ->with('iQC', $imgShow);
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
    public function singleProduct($id){
        $Product = DB::select
        (<<<EOT
            SELECT *
            FROM view_products AS v
            WHERE v.pro_sku = '$id'
            LIMIT 1

            EOT
        );

        if($Product == null) //Không có mã sản phẩm thì về trang chủ
        {
            return redirect('/');
        }

        $images = DB::select
        (<<<EOT
            SELECT *
            FROM related_image AS re, product AS pr
            WHERE re.pro_id = pr.pro_id AND pr.pro_sku = '$id'

            EOT
        );
        $mnfId =  $Product[0]->mnf_id;
        $proSame = DB::select
        (<<<EOT
            SELECT *
            FROM view_products AS v
            WHERE v.mnf_id = '$mnfId'
            LIMIT 10
            EOT
        );

        return view('frontend.pages.single-product')
                    ->with('product', $Product)
                    ->with('img', $images)
                    ->with('proSame', $proSame);
    }

    public static function showDetail($detail)
    {
        $data = explode ( ';', $detail);

        $tinhNang = explode ( ',', $data[5]);
        $tn1 = "";
        foreach($tinhNang as $str){
            $tn1 = $tn1. "<li>". $str ."</li>";
        }

        $tinhNang = explode ( ',', $data[7]);
        $tn2 = "";
        foreach($tinhNang as $str ){
            $tn2 = $tn2. "<li>". $str ."</li>";
        }

        return    " <table class='table table-hover'>
        <thead>
            <td colspan='2' > <b>Màn hình</b> </td>
        </thead>
        <tbody>
        <tr>
            <th scope='row'>Công nghệ màn hình </th>
            <td> $data[0] </td>
        </tr>

        <tr>
            <th scope='row'>Độ phân giải</th>
            <td> $data[1]</td>
        </tr>

        <tr>
            <th scope='row'>Màn hình rộng</th>
            <td> $data[2] </td>
        </tr>

        <tr>
            <th scope='row'>Mặt kính cảm ứng</th>
            <td> $data[3]</td>
        </tr>
        </tbody>
        <thead>
            <td colspan='2' > <b>Camera sau</b> </td>
        </thead>
        <tbody>
            <tr>
                <th scope='row'>Độ phân giải: </th>
                <td> $data[4]</td>
            </tr>
            <tr>
                <th scope='row'>Tính năng</th>
                <td> 
                    $tn1
                </td>
            </tr>
        </tbody>
        <thead>
            <td colspan='2' > <b>Camera trước</b> </td>
        </thead>
        <tbody>
            <tr>
                <th scope='row'>Độ phân giải </th>
                <td>$data[6]</td>
            </tr>
            <tr>
                <th scope='row'>Tính năng</th>
                <td>                      
                   $tn2
                </td>
            </tr>
        </tbody>
        <thead>
            <td colspan='2' > <b>Hệ điều hành & CPU</b> </td>
        </thead>
        <tbody>
            <tr>
                <th scope='row'>Hệ điều hành </th>
                <td> $data[8] </td>
            </tr>
            <tr>
                <th scope='row'>Chip xử lý (CPU)</th>
                <td>  $data[9]  </td>
            </tr>
            <tr>
                <th scope='row'>Tốc độ CPU </th>
                <td>$data[10]</td>
            </tr>
            <tr>
                <th scope='row'>Chip đồ họa (GPU)</th>
                <td>  $data[11]  </td>
            </tr>
            
        </tbody>
        <thead>
            <td colspan='2' > <b>Bộ nhớ & Lưu trữ</b> </td>
        </thead>
        <tbody>
            <tr>
                <th scope='row'>RAM: </th>
                <td> $data[12] </td>
            </tr>
            <tr>
                <th scope='row'>Bộ nhớ trong</th>
                <td>  $data[13] </td>
            </tr>
            <tr>
                <th scope='row'>Bộ nhớ còn lại (khả dụng) </th>
                <td>$data[14]</td>
            </tr>
            <tr>
                <th scope='row'>Thẻ nhớ ngoài</th>
                <td>   $data[15]  </td>
            </tr>
        </tbody>
        <thead>
            <td colspan='2' > <b>Thiết kế & Trọng lượng </b> </td>
        </thead>
        <tbody>
            <tr>
                <th scope='row'>Thiết kế </th>
                <td> $data[16]</td>
            </tr>
            <tr>
                <th scope='row'>Chất liệu</th>
                <td> $data[17]</td>
            </tr>
            <tr>
                <th scope='row'>Kích thước </th>
                <td>$data[18]</td>
            </tr>
            <tr>
                <th scope='row'>Trọng lượng</th>
                <td>  $data[19] </td>
            </tr>
        </tbody>
        <thead>
            <td colspan='2' > <b>Pin & Sạc </b> </td>
        </thead>
        <tbody>
            <tr>
                <th scope='row'>Dung lượng pin </th>
                <td>$data[20] </td>
            </tr>
            <tr>
                <th scope='row'>Loại pin</th>
                <td>   $data[21]  </td>
            </tr>
            <tr>
                <th scope='row'>Công nghệ pin</th>
                <td> $data[22]</td>
            </tr>
        </tbody>
    </table>";
    }

    
}
