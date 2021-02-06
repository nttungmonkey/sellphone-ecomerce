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
        $password = bcrypt('123456');
        $list = [
            ["acc_user" => 'admin', "acc_password" => $password, "acc_email" => 'email', "rol_id" => '1'],
            ["acc_user" => 'customer', "acc_password" => $password, "acc_email" => 'email', "rol_id" => '2']
        ];
        DB::table('account')->insert($list);
    }
}
