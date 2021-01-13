<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_detail', function (Blueprint $table) {
            $table->bigIncrements('emd_id');
            $table->unsignedInteger('emd_price')->comment('Giá bán # Giá bán mỗi sản phẩm, đơn vị Ngàn VND');
            $table->unsignedTinyInteger('emd_amount')->comment('Số lượng # Số lượng sản phẩm bán trên mỗi đơn hàng');

            $table->string('pro_sku', 14);
            $table->bigInt('bii_id');

            $table->foreign('pro_sku') 
                    ->references('pro_sku')->on('product') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

            $table->foreign('bii_id') 
                    ->references('bii_id')->on('bill_import') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

        });
        DB::statement("ALTER TABLE `export_detail` comment 'Chi tiết xuất # Chi tiết đơn hàng xuất'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('export_detail');
    }
}
