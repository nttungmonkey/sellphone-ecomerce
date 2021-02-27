<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlsanphamView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('slsanpham_view', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->timestamps();
        // });
        DB::statement("
            CREATE VIEW view_slsanpham AS
            (
                SELECT pr.pro_id, slNhap, slXuat, (slNhap - slXuat) AS slTon
                FROM product pr,
                    (
                        SELECT pr.pro_id, SUM(ed.emd_amount) AS slXuat
                        FROM product pr, export_detail ed
                        WHERE pr.pro_id = ed.pro_id
                        GROUP BY pr.pro_id
                    ) xuat,
                    (
                        SELECT pr.pro_id, SUM(id.imd_amount) AS slNhap
                        FROM product pr, import_detail id
                        WHERE pr.pro_id = id.pro_id
                        GROUP BY pr.pro_id
                    ) nhap
                WHERE pr.pro_id = nhap.pro_id AND
                        pr.pro_id = xuat.pro_id
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_slsanpham');
    }
}
