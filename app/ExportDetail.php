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
                    'pro_id',
                    'bie_id'
                ];
    protected $guarded      = ['emd_id'];

    protected $primaryKey   = 'emd_id';
    public function product()
    {
        return $this->belongsTo('App\Product', 'pro_id', 'pro_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\BillExport', 'bie_id', 'bie_id');
    }
}
