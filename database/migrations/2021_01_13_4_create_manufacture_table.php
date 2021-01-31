<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufactureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacture', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('mnf_id');
            $table->string('mnf_name', 100);
            $table->string('mnf_logo', 50);
            $table->timestamp('mnf_created')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo nhà sản xuất');
            $table->timestamp('mnf_updated')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật thông tin nhà sản xuất gần nhất');
            $table->unsignedTinyInteger('mnf_status')->default('1')->comment('Trạng thái # Trạng thái sản phẩm: 0-Đã xóa, 1-Khả dụng, 2-Đang khóa');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacture');
    }
}
