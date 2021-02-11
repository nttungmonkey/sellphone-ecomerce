<?php

use Illuminate\Database\Seeder;

class manufactureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        $manufacture = ['iphone', 'samsung', 'oppo', 'vivo', 'xiaomi'];
        $faker = Faker\Factory::create('vi_VN');

        for ($i=0; $i < count($manufacture) ; $i++) {
            $create= $faker->dateTimeBetween('-2 years','now', null);
            $update = $faker->dateTimeBetween($create,'+2 months', null);
            array_push($list, [
                'mnf_name'                => $manufacture[$i],
                'mnf_logo'                => "$manufacture[$i].png",
                'mnf_created'             => $create,
                'mnf_updated'             => $update
            ]);
        }
        DB::table('manufacture')->delete();
        DB::table('manufacture')->insert($list);
    }
}
