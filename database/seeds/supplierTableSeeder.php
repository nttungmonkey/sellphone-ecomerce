<?php

use Illuminate\Database\Seeder;

class supplierTableSeeder extends Seeder
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
                'sup_name'                => "Supplier$i",
                'sup_phonenum'            => "12345678$i",
                'sup_email'               => "suplierMail$i@gmail.com",
                'sup_note'                => "note$i",
                'adr_id'                  => $faker->numberBetween(1, 10),
            ]);
        }
        DB::table('supplier')->insert($list);
    }
}
