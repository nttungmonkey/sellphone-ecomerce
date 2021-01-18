<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillExport extends Model
{
    const     CREATED_AT    = 'bie_created';
    const     UPDATED_AT    = 'bie_updated';

    protected $table        = 'bill_export';
    protected $fillable     = 
        [
            'bie_created',
            'bie_updated',
            'bie_status',
            'acc_id'
        ];
    protected $guarded      = ['bie_id'];

    protected $primaryKey   = 'bie_id';

    protected $dates        = ['bie_created', 'bie_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}
