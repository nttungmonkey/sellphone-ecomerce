<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_image', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('pro_id')->comment('Sản phẩm # pro_id # pro_name # Mã sản phẩm');
            $table->unsignedTinyInteger('reimg_stt')->default('1')->comment('Số thứ tự # Số thứ tự hình ảnh của mỗi sản phẩm');
            $table->string('reimg_name', 150)->comment('Tên hình ảnh # Tên hình ảnh (không bao gồm đường dẫn)');
            
            $table->primary(['pro_id', 'reimg_name']);
            $table->foreign('pro_id')->references('pro_id')->on('product')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
        DB::statement("ALTER TABLE `related_image` comment 'Hình ảnh liên quan # Hình ảnh liên quan đến sản phẩm'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_image');
    }
}
