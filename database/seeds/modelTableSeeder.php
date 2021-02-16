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
       
        //danh sach san pham
        $iphone = ['iphone 11', 'iphone Xr', 'iphone Se'];
        $samsung = ['Galaxy Note', 'Galaxy S', 'Galaxy A', 'Galaxy Z', 'Galaxy M'];
        $oppo = ['Oppo A', 'Oppo Reno', 'Oppo Find X'];
        $vivo = ['Vivo X', 'Vivo V', 'Vivo Y', 'Vivo U', 'Vivo S'];
        $Xiaomi = ['Xiaomi Readmi', 'Xiaomi Mi', 'Xiaomi poco'];
        $faker = Faker\Factory::create('vi_VN');
        $manufacture =  DB::table('manufacture')->get();

        for($i = 0; $i < count($manufacture); $i++)
        {
            $item = $manufacture[$i];
            $model = [];
            switch($item->mnf_name)
            {
                case 'iphone' :
                    $model = $iphone;
                    break;
                case 'samsung' :
                    $model = $samsung;
                    break;
                case 'oppo' :
                    $model = $oppo;
                    break;
                case 'vivo' :
                    $model = $vivo;
                    break;
                case 'xiaomi' :
                    $model = $Xiaomi;
                    break;
            }

            for($j = 0; $j < count($model); $j++ )
            {
                $create = $faker->unique()->dateTimeBetween($item->mnf_created.'-20 days', $item->mnf_created)->format('Y-m-d');
                $update = $faker->unique()->dateTimeBetween($create, $create.'+10 days');

                array_push($list, [
                    'mod_name'                => $model[$j],
                    'mod_created'             => $create,
                    'mod_updated'             => $update,
                    'mnf_id'                  => $item->mnf_id,
                ]);
            }
        }

        DB::table('models')->delete();
        DB::table('models')->insert($list);
    }
}
