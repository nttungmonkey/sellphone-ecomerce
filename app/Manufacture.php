<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    const     CREATED_AT    = 'mnf_created';
    const     UPDATED_AT    = 'mnf_updated';

    protected $table        = 'manufacture';
    protected $fillable     =
            [
                'mnf_name',
                'mnf_logo',
                'mnf_created',
                'mnf_updated',
                'mnf_status'
            ];
    protected $guarded      = ['mnf_id'];

    protected $primaryKey   = 'mnf_id';

    protected $dates        = ['mnf_created', 'mnf_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';
    
    public function models()
    {
        return $this->hasMany('App\Models', 'mnf_id', 'mnf_id');
    }
}
