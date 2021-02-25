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
            FROM (
                SELECT p.*, MAX(bi.bii_updated) AS da 
                FROM product as p, import_detail as id,  bill_import as bi
                WHERE p.pro_id = id.pro_id AND id.bii_id = bi.bii_id
                GROUP BY p.pro_id) AS p, import_detail AS id, bill_import AS bi, models AS m
            WHERE p.da = bi.bii_updated AND
                    bi.bii_id = id.bii_id AND
                    p.pro_id = id.pro_id AND 
                    m.mod_id = p.mod_id AND 
                    id.pro_id = p.pro_id
            ORDER BY da desc
            limit 10

            EOT
        );

        $spBanChay = DB::select
        (<<<EOT
            SELECT p.*, m.*, id.*, SUM(ed.emd_amount) as sl
            FROM product as p, models as m, import_detail as id, export_detail as ed, bill_import as bi
            WHERE p.mod_id = m.mod_id AND p.pro_id = id.pro_id AND p.pro_id = ed.pro_id AND id.bii_id = bi.bii_id
            GROUP BY p.pro_id
            ORDER BY bi.bii_created DESC, sl DESC
            LIMIT 10

            EOT
        );

        $spre = DB::select
        (<<<EOT
            SELECT p.*, m.*, id.*
            FROM product as p, models as m, import_detail as id, export_detail as ed, bill_import as bi
            WHERE p.mod_id = m.mod_id AND p.pro_id = id.pro_id AND p.pro_id = ed.pro_id AND id.bii_id = bi.bii_id
            GROUP BY p.pro_id
            ORDER BY id.imd_priceExp
            LIMIT 10

            EOT
        );

        $spViVo = DB::select
        (<<<EOT
            SELECT p.*, m.*, id.*, (SUM(id.imd_amount) - SUM(ed.emd_amount)) as sl
            FROM product as p, models as m, import_detail as id, export_detail as ed, bill_import as bi, manufacture as ma
            WHERE p.mod_id = m.mod_id AND p.pro_id = id.pro_id AND p.pro_id = ed.pro_id AND id.bii_id = bi.bii_id AND ma.mnf_id = m.mnf_id AND ma.mnf_name = 'vivo'
            GROUP BY p.pro_id
            ORDER BY bi.bii_created DESC
            LIMIT 3

            EOT
        );
        $spSamSung = DB::select
        (<<<EOT
            SELECT p.*, m.*, id.*, (SUM(id.imd_amount) - SUM(ed.emd_amount)) as sl
            FROM product as p, models as m, import_detail as id, export_detail as ed, bill_import as bi, manufacture as ma
            WHERE p.mod_id = m.mod_id AND p.pro_id = id.pro_id AND p.pro_id = ed.pro_id AND id.bii_id = bi.bii_id AND ma.mnf_id = m.mnf_id AND ma.mnf_name = 'samsung'
            GROUP BY p.pro_id
            ORDER BY bi.bii_created DESC
            LIMIT 3

            EOT
        );
        $spOppo = DB::select
        (<<<EOT
            SELECT p.*, m.*, id.*, (SUM(id.imd_amount) - SUM(ed.emd_amount)) as sl
            FROM product as p, models as m, import_detail as id, export_detail as ed, bill_import as bi, manufacture as ma
            WHERE p.mod_id = m.mod_id AND p.pro_id = id.pro_id AND p.pro_id = ed.pro_id AND id.bii_id = bi.bii_id AND ma.mnf_id = m.mnf_id AND ma.mnf_name = 'oppo'
            GROUP BY p.pro_id
            ORDER BY bi.bii_created DESC
            LIMIT 3

            EOT
        );

        return view('frontend.index')
                ->with('product', $spMoi)
                ->with('bestsell', $spBanChay)
                ->with('bestcheap', $spre)
                ->with('spVivo', $spViVo)
                ->with('spSamsung', $spSamSung)
                ->with('spOppo', $spOppo);
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
            FROM product AS pr, models AS mo, manufacture ma, import_detail AS im, bill_import AS bi
            WHERE pr.mod_id = mo.mod_id AND	mo.mnf_id = ma.mnf_id AND pr.pro_id = im.pro_id AND im.bii_id = bi.bii_id
            AND pr.pro_sku = '$id'
            ORDER BY bi.bii_updated DESC
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
        $modeID =  $Product[0]->mod_id;
        $proSame = DB::select
        (<<<EOT
            SELECT *
            FROM product AS pr, models AS mo, manufacture ma, import_detail AS im, bill_import AS bi, 
                (SELECT pr.pro_id AS Muc, MAX(bi.bii_updated) AS CaKeo
                FROM product AS pr, models AS mo, manufacture ma, import_detail AS im, bill_import AS bi
                WHERE pr.mod_id = mo.mod_id AND	mo.mnf_id = ma.mnf_id AND pr.pro_id = im.pro_id AND im.bii_id = bi.bii_id
                GROUP BY pr.pro_id) AS Lau
            WHERE pr.mod_id = mo.mod_id AND	mo.mnf_id = ma.mnf_id AND pr.pro_id = im.pro_id AND im.bii_id = bi.bii_id
            AND bi.bii_updated = Lau.CaKeo AND pr.pro_id = Lau.Muc AND mo.mod_id = $modeID
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
