<?php

use Illuminate\Database\Seeder;

class modelTableSeeder extends Seeder
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
                'mod_name'                => "Model$i",
                'mnf_id'                  => $faker->numberBetween(1, 10),
            ]);
        }
        DB::table('models')->insert($list);
    }
}
