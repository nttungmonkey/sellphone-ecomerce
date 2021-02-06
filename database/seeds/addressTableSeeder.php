<?php

use Illuminate\Database\Seeder;

class addressTableSeeder extends Seeder
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
                'adr_address'             => $faker->streetAddress(),
                'acc_id'                  => $faker->numberBetween(1, 2),
            ]);
        }
        DB::table('address')->insert($list);
    }
}
