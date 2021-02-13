<?php

use Illuminate\Database\Seeder;

class exportDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        
        $faker = Faker\Factory::create('vi_VN');
        $imDetail = DB::table('import_detail')->get();
        $bill = DB::table('bill_export')->get();


        for ($i=0; $i < 80 ; $i++) {
            $idIm   =   $faker->numberBetween(0,count($imDetail) - 1);
            $idBill =   $faker->numberBetween(0,count($bill) - 1);
            array_push($list, [
                'emd_price'     => $imDetail[$idIm]->imd_priceExp * $faker->randomFloat(NULL,0.8,1.2),
                'emd_amount'    => $faker->numberBetween(1,$imDetail[$idIm]->imd_amount),
                'pro_id'        => $imDetail[$idIm]->pro_id,
                'bie_id'        => $bill[$idBill]->bie_id
            ]);
        }
        DB::table('export_detail')->delete();
        DB::table('export_detail')->insert($list);
    }
}
