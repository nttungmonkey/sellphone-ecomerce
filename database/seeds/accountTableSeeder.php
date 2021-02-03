<?php

use Illuminate\Database\Seeder;

class accountTableSeeder extends Seeder
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
                'acc_user'                => "user$i",
                'acc_password'            => "password$i",
                'acc_fullname'            => "fullname$i",
                'acc_sex'                 => $faker->numberBetween(1, 2),
                'acc_picture'              => "hinh$i.png",
                'rol_id'                 => $faker->numberBetween(1, 2)
            ]);
        }
        DB::table('account')->insert($list);
    }
}
