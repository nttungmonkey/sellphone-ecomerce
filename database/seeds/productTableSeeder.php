<?php

use Illuminate\Database\Seeder;

class productTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        $faker    = Faker\Factory::create('vi_VN');
        $df = "lại tiếp tục cho ra mắt chiếc smartphone mới thuộc thế hệ Galaxy M với tên gọi. 
        Thiết kế mới này tuy nằm trong phân khúc tầm trung nhưng được nâng cấp 
        và cải tiến với camera góc siêu rộng, dung lượng pin siêu khủng cùng vẻ ngoài sang trọng và thời thượng.
        Thiết kế hiện đại và đẳng cấp.
        Ấn tượng ban đầu với màn hình của là kiểu màn hình Infinity-O rộng 6.7 inch. 
        Kiểu thiết kế này đưa camera selfie thu gọn hơn chỉ bằng một hình tròn nhỏ cùng thiết kế màn hình tràn viền làm 
        tăng khả năng hiển thị hình ảnh hơn.
        Ngoài ra, máy còn sở hữu công nghệ màn hình Super AMOLED Plus mang đến chất lượng hiển thị sắc nét, 
        hình ảnh tươi tắn cho bạn tận hưởng các chương trình giải trí hấp dẫn, thưởng thức các bộ phim bom tấn, chơi những tựa game yêu thích vô cùng bắt mắt.";

        $congNgheManHinh = ['IPS LCD','AMOLED','IPS Quantum', 'LED-backlit IPS LCD','ClearBlack','Super LCD (S-LCD)','TFT-LCD','LTPS LCD','PLS LCD','IPS LCD, 6.0", HD+',' Super AMOLED Plus '];
        $doPhanGiaiScreen = ['Full HD+ (1080 x 2400 Pixels)',' HD+ (720 × 1480 Pixels) ','HD (720 x 1280 Pixels)','DVGA (640 x 960 Pixels)','FWVGA (480 x 854 Pixels)',' 2K (1440 x 2560 Pixels) ','1170 x 2532 Pixels'];
        $doPhanGiaiCam = [' 12 MP ','8 MP', '1 MP', '48 MP', '4 MP', '2 MP'];
        $matKinhCamUng = [' Kính cường lực Corning Gorilla Glass 3 ','Kính cường lực Corning Gorilla Glass','Mặt kính cong 2.5D',' Kính cường lực Ceramic Shield ',' Kính cường lực Corning Gorilla Glass Victus '];
        $manHinhRong = ['6.5 inch','6.7 inch', '6.52 inch', '7.0 inch', '8.0 inch', '6.1 inch','5.2 inch'];
        $tinhnang = ['Xóa phông','Chạm lấy nét','Toàn cảnh (Panorama)','Làm đẹp (Beautify)','Tự động lấy nét (AF)','Nhận diện khuôn mặt','HDR','Góc rộng (Wide)','Siêu cận (Macro)','Góc siêu rộng (Ultrawide)'];
        $heDieuhanh = ['Android 10','iOS 14','Android 9','Android 8','Android 7','iOS 13','iOS 12'];
        $chipXuLy = ['Snapdragon 730 8 nhân','MediaTek Helio G35 8 nhân','Snapdragon 865+ 8 nhân',' MediaTek Helio P35 8 nhân '];
        $tocDoCPU = [' 2 nhân 3.1 GHz & 4 nhân 1.8 GHz ','1 nhân 3.09 Ghz & 3 nhân 2.4 Ghz & 4 nhân 1.8 Ghz','2 nhân 3.1 GHz & 4 nhân 1.8 GHz'];
        $chipDoHoa = [' Apple GPU 6 nhân ','Adreno 650','Mali-G77 MP11','Đang cập nhật'];
        $ram = ['Không','2 GB', '1 GB', '4 GB', '6 GB', '8 GB', '12 GB', '16 GB', '32 GB'];
        $boNhoTrong = ['16 GB - Khoảng 12 GB','16 GB - Khoảng 10 GB','32 GB - Khoảng 20 GB','32 GB - Khoảng 28 GB','64 GB - Khoảng 40 GB','64 GB - Khoảng 60 GB','128 GB - Khoảng 120 GB','256 GB - Khoảng 250 GB','512 GB - Khoảng 508 GB'];
        $theNhoNgoai = ['MicroSD, hỗ trợ tối đa 256 GB','MicroSD, hỗ trợ tối đa 512 GB','MicroSD, hỗ trợ tối đa 128 GB','MicroSD, hỗ trợ tối đa 1 TB','MicroSD, hỗ trợ tối đa 64 GB'];
        $thietke = ['Nguyên khối','Pin rời'];
        $chatLieu = [' Khung thép không gỉ & Mặt lưng kính cường lực ','Khung kim loại & Mặt lưng kính cường lực','Khung nhôm & Mặt lưng kính cường lực',' Khung & Mặt lưng nhựa '];
        $kichThuoc = ['Dài 164.8 mm - Ngang 77.2 mm - Dày 8.1 mm','Dài 160.8 mm - Ngang 78.1 mm - Dày 7.4 mm','Dài 159.2 mm - Ngang 128.2 mm - Dày 6.9 mm','Dài 146.7 mm - Ngang 71.5 mm - Dày 7.4 mm','Dài 164 mm - Ngang 75.4 mm - Dày 7.9 mm'];
        $trongLuong = ['175 g','164 g','200 g', '228 g', '208 g','212 g', '177 g', '190 g'];
        $dungnLuongPin = ['7000 mAh','5000 mAh','4800 mAh',' 4500 mAh ','3687 mAh','2815 mAh'];
        $loaiPin = ['Li-Ion','Li Po'];
        $congNghePin = ['Tiết kiệm pin','Sạc Nhanh','Sạc Không dây', 'Siêu tiết kiệm pin','Sạc MagSafe'];


        for ($i=1; $i <= 30; $i++) {
            $memory = explode ( '-', $boNhoTrong[$faker->numberBetween(0, count($boNhoTrong)-1)]);
            $tinhNang1 = $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] . ','.
                         $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] . ','.
                         $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] . ','.
                         $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] . ','.
                         $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] ;
            $tinhnang[$faker->unique(true)->numberBetween(0, count($tinhnang)-1)];//reset

            $tinhNang2 = $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] . ','.
                         $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] . ','.
                         $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] . ','.
                         $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] . ','.
                         $tinhnang[$faker->unique()->numberBetween(0, count($tinhnang)-1)] ;
            $tinhnang[$faker->unique(true)->numberBetween(0, count($tinhnang)-1)];//reset
            
            $chiTiet =
            $congNgheManHinh[$faker->numberBetween(0, count($congNgheManHinh)-1)] . ';'.
            $doPhanGiaiScreen[$faker->numberBetween(0, count($doPhanGiaiScreen)-1)] . ';'.
            $manHinhRong[$faker->numberBetween(0, count($manHinhRong)-1)] . ';'.
            $matKinhCamUng[$faker->numberBetween(0, count($matKinhCamUng)-1)] . ';'.

            $doPhanGiaiCam[$faker->numberBetween(0, count($doPhanGiaiCam)-1)] . ';'.
            $tinhNang1 . ';'.

            $doPhanGiaiCam[$faker->numberBetween(0, count($doPhanGiaiCam)-1)] . ';'.
            $tinhNang2 . ';'.

            $heDieuhanh[$faker->numberBetween(0, count($heDieuhanh)-1)] . ';'.
            $chipXuLy[$faker->numberBetween(0, count($chipXuLy)-1)] . ';'.
            $tocDoCPU[$faker->numberBetween(0, count($tocDoCPU)-1)] . ';'.
            $chipDoHoa[$faker->numberBetween(0, count($chipDoHoa)-1)] . ';'.

            $ram[$faker->numberBetween(0, count($ram)-1)] . ';'.
            $memory[0] . ';'. $memory[1]. ';'.
            $theNhoNgoai[$faker->numberBetween(0, count($theNhoNgoai)-1)] . ';'.
            $thietke[$faker->numberBetween(0, count($thietke)-1)] . ';'.
            $chatLieu[$faker->numberBetween(0, count($chatLieu)-1)] . ';'.
            $kichThuoc[$faker->numberBetween(0, count($kichThuoc)-1)] . ';'.
            $trongLuong[$faker->numberBetween(0, count($trongLuong)-1)] . ';'.

            $dungnLuongPin[$faker->numberBetween(0, count($dungnLuongPin)-1)] . ';'.
            $loaiPin[$faker->numberBetween(0, count($loaiPin)-1)] . ';'.
            $congNghePin[$faker->numberBetween(0, count($congNghePin)-1)] . ';';

            array_push($list, [
                'pro_sku'                => $faker->unique()->numberBetween(14000000000000, 99999999999999),
                'pro_name'               => "product$i",
                'pro_image'                 => "image$i.png",
                'pro_detail'                 => $chiTiet,
                'pro_descriptS'              => "description sort $i ". $faker->text,
                'pro_descriptF'             => "description full $i ". $df,
                'mod_id'                    => $faker->numberBetween(1, 19),
                'sup_id'                    => $faker->numberBetween(1, 10)
            ]);
        }
        
        DB::table('product')->insert($list);
    }
}
