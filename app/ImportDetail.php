<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    public    $timestamps   = false; 

    protected $table        = 'import_detail';
    protected $fillable     = 
                [
                    'imd_price',
                    'imd_amount',
                    'pro_sku',
                    'bii_id'
                ];
    protected $guarded      = ['imd_id'];

    protected $primaryKey   = 'imd_id';

}
