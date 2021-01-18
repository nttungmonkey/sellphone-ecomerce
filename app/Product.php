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
    protected $guarded      = ['pro_sku'];

    protected $primaryKey   = 'pro_sku';

    protected $dates        = ['pro_created', 'pro_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}
