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
        for ($i=1; $i <= 20; $i++) {
            $chiTiet =
            "
                <b>Công nghệ màn hình:<\b> 
                Độ phân giải:
                Màn hình rộng:
            ";

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
