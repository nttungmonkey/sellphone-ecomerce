<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportDetail extends Model
{
    public    $timestamps   = false; 

    protected $table        = 'export_detail';
    protected $fillable     = 
                [
                    'emd_price',
                    'emd_amount',
                    'pro_sku',
                    'bii_id'
                ];
    protected $guarded      = ['emd_id'];

    protected $primaryKey   = 'emd_id';

}
