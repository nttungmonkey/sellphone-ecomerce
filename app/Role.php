<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;

class Role extends Model
{
    const     CREATED_AT    = 'rol_created';
    const     UPDATED_AT    = 'rol_updated';

    protected $table        = 'role';
    protected $fillable     = 
            [
                'rol_name',
                'rol_description',
                'rol_created',
                'rol_updated'
            ];
    protected $guarded      = ['rol_id'];

    protected $primaryKey   = 'rol_id';

    protected $dates        = ['rol_created', 'rol_updated'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function accounts()
    {
    return $this->belongsToMany(Account::class, 'account_role','rol_id','acc_id');
    }
}
