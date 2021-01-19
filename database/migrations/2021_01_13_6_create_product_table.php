<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->string('pro_sku', 14)->primary();
            $table->string('pro_name', 100);
            $table->string('pro_image', 50);
            $table->text('pro_detail')->comment('Thông tin chi tiết # Thông số sản phẩm, mỗi giá trị cách nhau dấu|');
            $table->string('pro_descriptS', 200)->comment('Mô tả ngắn # Mô tả ngắn về sản phẩm');
            $table->text('pro_descriptF')->comment('Mô tả chi tiết # Mô tả chi tiết về sản phẩm');

            $table->timestamp('pro_created')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo sản phẩm');
            $table->timestamp('pro_updated')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật thông tin sản phẩm gần nhất');
            $table->unsignedTinyInteger('pro_status')->default('3')->comment('Trạng thái # Trạng thái sản phẩm: 1-Đang bán, 2-Đang vận chuyển, 3-Đã bán, 4-chưa bán');
            
            $table->unsignedInteger('mod_id');
            $table->unsignedSmallInteger('sup_id');

            $table->foreign('mod_id') 
                    ->references('mod_id')->on('models') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

            $table->foreign('sup_id') 
                    ->references('sup_id')->on('supplier') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

        });
        DB::statement("ALTER TABLE `product` comment 'Sản phẩm # Sản phẩm'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
