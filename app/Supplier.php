<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    const     CREATED_AT    = 'sup_created';
    const     UPDATED_AT    = 'sup_updated';

    protected $table        = 'supplier';
    protected $fillable     =
            [
                'sup_name',
                'sup_phonenum',
                'sup_email',
                'sup_note',
                'sup_created',
                'sup_updated',
                'sup_status',
                'adr_id'
            ];
    protected $guarded      = ['sup_id'];

    protected $primaryKey   = 'sup_id';

    protected $dates        = ['sup_created', 'sup_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}
