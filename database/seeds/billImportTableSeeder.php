<?php

use Illuminate\Database\Seeder;

class billImportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Nhập hàng
        $list = [];
        
        $faker = Faker\Factory::create('vi_VN');
        $acc = DB::table('account')->whereIn('acc_user',['admin','thanh292','kien564'])->get();

        for ($i=0; $i < 40 ; $i++) {
            $create= $faker->unique()->dateTimeBetween('-2 years','now', null)->format('Y-m-d');
            $update = $faker->unique()->dateTimeBetween($create, $create.'+2 months', null);
            $idAcc = $faker->numberBetween(0,2);
            array_push($list, [
                'bii_created'   => $create,
                'bii_updated'   => $update,
                'acc_id'        => $acc[$idAcc]->acc_id,
                'bii_status'    => '1'
            ]);
        }
        DB::table('bill_import')->delete();
        DB::table('bill_import')->insert($list);
    }
}
