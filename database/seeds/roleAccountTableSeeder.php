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
        for ($i=1; $i <= 2; $i++) {
            array_push($list, [
                'rol_id'                 => $i,
                'acc_id'                 => $i
            ]);
        }
        for ($i=3; $i <= 20; $i++) {
            array_push($list, [
                'rol_id'                 => 2,
                'acc_id'                 => $i
            ]);
        }
        DB::table('account_role')->insert($list);
    }
}
