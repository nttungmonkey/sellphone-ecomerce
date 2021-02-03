<?php

use Illuminate\Database\Seeder;

class roleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            ["rol_name" => 'admin'],
            ["rol_name" => 'customer']
        ];
        DB::table('role')->insert($list);
    }
}
