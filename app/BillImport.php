<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillImport extends Model
{
    const     CREATED_AT    = 'bii_created';
    const     UPDATED_AT    = 'bii_updated';

    protected $table        = 'bill_import';
    protected $fillable     =
            [
                'bii_created',
                'bii_updated',
                'bii_status',
                'acc_id'
            ];
    protected $guarded      = ['bii_id'];

    protected $primaryKey   = 'bii_id';

    protected $dates        = ['bii_created', 'bii_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function detail()
    {
        return $this->hasMany('App\ImportDetail', 'bii_id', 'bii_id');
    }

    public function acc()
    {
        return $this->belongsTo('App\Account', 'acc_id', 'acc_id');
    }


}
