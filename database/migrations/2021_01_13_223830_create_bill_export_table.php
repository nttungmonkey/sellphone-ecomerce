<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillExportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_export', function (Blueprint $table) {
            $table->bigIncrements('bie_id');
            
            $table->timestamp('bie_created')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo đơn hàng xuất');
            $table->timestamp('bie_updated')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật thông tin đơn hàng xuất gần nhất');
            $table->unsignedTinyInteger('bie_status')->default('1')->comment('Trạng thái # Trạng thái hóa đơn: 1-Khách hàng tạo, 2-Nhân viên xác nhận, 3-Đã giao hàng, 4-Đã hủy');
            
            $table->bigInt('acc_id');

            $table->foreign('acc_id') 
                    ->references('acc_id')->on('account') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');
        });
        DB::statement("ALTER TABLE `bill_export` comment 'Đơn hàng bán sản phẩm # Đơn hàng do khách đặt'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_export');
    }
}
