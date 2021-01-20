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
                    'pro_id',
                    'bii_id'
                ];
    protected $guarded      = ['imd_id'];

    protected $primaryKey   = 'imd_id';

    public function product()
    {
        return $this->belongsTo('App\Product', 'pro_id', 'pro_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\BillExport', 'bie_id', 'bie_id');
    }
}
