<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_role', function (Blueprint $table) {
            $table->increments('rolacc_id');
            $table->unsignedInteger('rol_id');
            $table->unsignedBigInteger('acc_id');

            $table->foreign('rol_id') 
                    ->references('rol_id')->on('role') 
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

            $table->foreign('acc_id') 
            ->references('acc_id')->on('account') 
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
        });

        DB::statement("ALTER TABLE `account_role` comment 'Quyền - Account # Quyền của account'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_account');
    }
}
