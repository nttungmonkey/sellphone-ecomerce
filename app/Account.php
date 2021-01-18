<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const     CREATED_AT    = 'acc_created';
    const     UPDATED_AT    = 'acc_updated';

    protected $table        = 'account';
    protected $fillable     = 
            [
                'acc_user',
                'acc_password',
                'acc_fullname',
                'acc_sex',
                'acc_birthday',
                'acc_phonenum',
                'acc_email',
                'acc_picture',
                'acc_created',
                'acc_updated',
                'acc_status',
                'acc_permission'
            ];
    protected $guarded      = ['acc_id'];

    protected $primaryKey   = 'acc_id';

    protected $dates        = ['acc_created', 'acc_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}
