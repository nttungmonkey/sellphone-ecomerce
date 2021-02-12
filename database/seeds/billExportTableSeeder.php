<?php

use Illuminate\Database\Seeder;

class billExportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //đặt hàng
        $list = [];
        
        $faker = Faker\Factory::create('vi_VN');
        $acc = DB::table('account')->where('rol_id','2')->get();

        for ($i=0; $i < 10 ; $i++) {
            $today= $faker->dateTimeBetween('-2 years','now', null);
            
            $idAcc = $faker->numberBetween(0,count($acc) - 1);
            array_push($list, [
                'bie_created'   => $today,
                'bie_updated'   => $today,
                'acc_id'        => $acc[$idAcc]->acc_id,
                'bie_status'    => '1'
            ]);
        }
        DB::table('bill_export')->delete();
        DB::table('bill_export')->insert($list);
    }
}
