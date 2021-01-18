<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    const     CREATED_AT    = 'adr_created';
    const     UPDATED_AT    = 'adr_updated';

    protected $table        = 'adddress';
    protected $fillable     = 
            [
                'adr_address',
                'adr_created',
                'adr_updated',
                'acc_id'
            ];
protected $guarded      = ['adr_id'];

    protected $primaryKey   = 'adr_id';

    protected $dates        = ['adr_created', 'adr_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}
