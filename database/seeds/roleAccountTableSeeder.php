<?php

use Illuminate\Database\Seeder;

class roleAccountTableSeeder extends Seeder
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
            array_push($list, [
                'rol_id'                 => $faker->numberBetween(1, 2),
                'acc_id'                 => $faker->numberBetween(1, 10)
            ]);
        }
        DB::table('account_role')->insert($list);
    }
}
