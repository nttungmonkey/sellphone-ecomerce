<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('rol_id');
            $table->string('rol_name');
            $table->text('rol_description')->nullable();
            $table->timestamp('rol_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('rol_updated')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        DB::statement("ALTER TABLE `role` comment 'Quyền người dùng # Quyền người dùng'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
