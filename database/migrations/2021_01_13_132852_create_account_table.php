<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->bigIncrements('acc_id');
            $table->string('acc_user', 50);
            $table->string('acc_password', 250);
            $table->string('acc_fullname', 100);
            $table->unsignedTinyInteger('acc_sex')->default('1')->comment('Giới tính # Giới tính: 0-Nữ, 1-Nam, 2-Khác');
            $table->dateTime('acc_birthday')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Ngày sinh # Ngày sinh');
            $table->string('acc_phonenum', 11);
            $table->string('acc_email', 100);
            $table->string('acc_picture', 50);
            $table->timestamp('acc_created')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo tài khoản');
            $table->timestamp('acc_updated')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật thông tin tài khoản gần nhất');
            $table->unsignedTinyInteger('acc_status')->default('3')->comment('Trạng thái # Trạng thái tài khoản: 1-khóa, 2-khả dụng, 3-chưa kích hoạt, 4-Đã xóa');
            $table->unsignedTinyInteger('acc_permission')->default('1')->comment('Quyền # Quyền của tài khoản: 1-khách hàng, 2-Nhân viên');
        });
        DB::statement("ALTER TABLE `account` comment 'Tài khoản người dùng # Tài khoản người dùng, bao gồm khách hàng và nhân viên'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account');
    }
}
