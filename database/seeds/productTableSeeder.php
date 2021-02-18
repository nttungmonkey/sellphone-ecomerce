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
        $faker    = Faker\Factory::create();
        for ($i=1; $i <= 20; $i++) {
            $today = new DateTime();
            array_push($list, [
                'pro_sku'                => $faker->numberBetween(14000000000000, 99999999999999),
                'pro_name'               => "product$i",
                'pro_image'                 => "image.jpg",
                'pro_detail'                 => "detail$i",
                'pro_descriptS'              => "description sort $i",
                'pro_descriptF'             => "description full $i",
                'mod_id'                    => $faker->numberBetween(1, 19),
                'sup_id'                    => $faker->numberBetween(1, 10)
            ]);
        }
        DB::table('product')->insert($list);
    }
}
