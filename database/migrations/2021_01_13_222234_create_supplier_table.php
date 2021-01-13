<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->smallIncrements('sup_id');
            $table->string('sup_name', 100);
            $table->string('sup_phonenum', 11);
            $table->string('sup_email', 100);
            $table->text('sup_note');

            $table->timestamp('sup_created')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo nhà cung cấp');
            $table->timestamp('sup_updated')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật thông tin nhà cung cấp gần nhất');
            $table->unsignedTinyInteger('sup_status')->default('1')->comment('Trạng thái # Trạng thái sản phẩm: 1-Khả dụng, 2-Đang khóa');
            $table->bigint('adr_id');

            $table->foreign('adr_id') 
                    ->references('adr_id')->on('address') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');
        });
        DB::statement("ALTER TABLE `supplier` comment 'Nhà cung cấp # Nhà cung cấp sản phẩm cho công ty'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier');
    }
}
