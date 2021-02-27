<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVProductView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('v_product_view', function (Blueprint $table) {
            
        // });
        DB::statement("
            CREATE VIEW view_products AS
            (
                SELECT  pr.pro_id, pr.pro_sku, pr.pro_name, pr.pro_image, pr.pro_detail, 
                        pr.pro_descriptS, pr.pro_descriptF, id.imd_price, 
                        id.imd_priceExp, m.mod_id, m.mod_name, m.mnf_id, bi.bii_updated, ma.mnf_name
                FROM (
                    SELECT p.*, MAX(bi.bii_updated) AS da 
                    FROM product as p, import_detail as id,  bill_import as bi
                    WHERE p.pro_id = id.pro_id AND id.bii_id = bi.bii_id
                    GROUP BY p.pro_id) AS pr, import_detail AS id, bill_import AS bi, models AS m, manufacture ma
                WHERE pr.da = bi.bii_updated AND
                        bi.bii_id = id.bii_id AND
                        pr.pro_id = id.pro_id AND 
                        m.mod_id = pr.mod_id AND 
                        id.pro_id = pr.pro_id and
                        ma.mnf_id = m.mnf_id
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
        Schema::dropIfExists('v_product_view');
    }
}
