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
            $table->engine = 'InnoDB';
            $table->bigIncrements('acc_id');
            $table->string('acc_user', 50)->comment('Tài khoản người dùng # Tài khoản người dùng');
            $table->string('acc_password', 250)->comment('Mật khẩu đăng nhập # Mật khẩu đã mã hóa');
            $table->string('acc_fullname', 100)->comment('Tên đầy đủ # Tên đầy đủ của người dùng');
            $table->unsignedTinyInteger('acc_sex')->default('1')->comment('Giới tính # Giới tính: 0-Nữ, 1-Nam, 2-Khác');
            $table->dateTime('acc_birthday')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Ngày sinh # Ngày sinh');
            $table->string('acc_phonenum', 11)->nullable()->comment('Số điện thoại # Số điện thoại người dùng');
            $table->string('acc_email', 100)->nullable()->comment('Địa chỉ Email # Địa chỉ Email người dùng');
            $table->string('acc_picture', 50);
            $table->timestamp('acc_created')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo tài khoản');
            $table->timestamp('acc_updated')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật thông tin tài khoản gần nhất');
            $table->unsignedTinyInteger('acc_status')->default('3')->comment('Trạng thái # Trạng thái tài khoản: 0-Đã xóa, 1-khóa, 2-khả dụng, 3-chưa kích hoạt, 4-Đã xóa');
            $table->unsignedInteger('rol_id');
            $table->string('acc_remember')->nullable()->comment('Ghi nhớ đăng nhập');

            $table->foreign('rol_id') 
                    ->references('rol_id')->on('role') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

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
