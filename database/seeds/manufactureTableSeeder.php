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
        $faker    = Faker\Factory::create();
        for ($i=1; $i <= 10; $i++) {
            $today = new DateTime();
            array_push($list, [
                'mnf_name'                => "Manufacture$i",
                'mnf_logo'                => "logo$i",
            ]);
        }
        DB::table('manufacture')->insert($list);
    }
}
