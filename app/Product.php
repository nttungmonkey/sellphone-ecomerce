<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const     CREATED_AT    = 'pro_created';
    const     UPDATED_AT    = 'pro_updated';

    protected $table        = 'product';
    protected $fillable     =
            [
                'pro_sku',
                'pro_name',
                'pro_image',
                'pro_detail',
                'pro_descriptS',
                'pro_descriptF',
                'pro_created',
                'pro_updated',
                'pro_status',
                'mod_id',
                'sup_id'
            ];
    protected $guarded      = ['pro_id'];

    protected $primaryKey   = 'pro_id';

    protected $dates        = ['pro_created', 'pro_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';
    
    public function models()
    {
        return $this->belongsTo('App\Models', 'mod_id', 'mod_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'sup_id', 'sup_id');
    }

    public function importdetail()
    {
        return $this->hasMany('App\ImportDetail', 'pro_id', 'pro_id');
    }

    public function exportdetail()
    {
        return $this->hasMany('App\ExportDetail', 'pro_id', 'pro_id');
    }

}
