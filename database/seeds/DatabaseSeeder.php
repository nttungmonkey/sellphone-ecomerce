<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(roleTableSeeder::class);
        $this->call(accountTableSeeder::class);
        $this->call(roleAccountTableSeeder::class);
        $this->call(addressTableSeeder::class);
        $this->call(supplierTableSeeder::class);
        $this->call(manufactureTableSeeder::class);
        $this->call(modelTableSeeder::class);
        $this->call(productTableSeeder::class);
        $this->call(billImportTableSeeder::class);
        $this->call(billExportTableSeeder::class);
        $this->call(importDetailTableSeeder::class);
        $this->call(exportDetailTableSeeder::class);
        $this->call(relatedImageTableSeeder::class);
        
    }
}
