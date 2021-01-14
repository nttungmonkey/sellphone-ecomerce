<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillImportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_import', function (Blueprint $table) {
            $table->bigIncrements('bii_id');

            $table->timestamp('bii_created')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo hóa đơn nhập');
            $table->timestamp('bii_updated')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật thông tin hóa đơn nhập gần nhất');
            $table->unsignedTinyInteger('bii_status')->default('1')->comment('Trạng thái # Trạng thái hóa đơn: 1-Khả dụng, 2-Đã xóa');
            
            $table->unsignedBigInteger('acc_id');

            $table->foreign('acc_id') 
                    ->references('acc_id')->on('account') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

        });
        DB::statement("ALTER TABLE `bill_import` comment 'Hóa đơn nhập hàng # Hóa đơn nhập hàng vào kho'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_import');
    }
}
