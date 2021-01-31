<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    const     CREATED_AT    = 'mod_created';
    const     UPDATED_AT    = 'mod_updated';

    protected $table        = 'models';
    protected $fillable     =
            [
                'mod_name',
                'mod_created',
                'mod_updated',
                'mod_status',
                'mod_note',
                'mnf_id'
            ];
    protected $guarded      = ['mod_id'];

    protected $primaryKey   = 'mod_id';

    protected $dates        = ['mod_created', 'mod_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function products()
    {
        return $this->hasMany('App\Product', 'mod_id', 'mod_id');
    }

    public function manufacture()
    {
        return $this->belongsTo('App\Manufacture', 'mnf_id', 'mnf_id');
    }
}
