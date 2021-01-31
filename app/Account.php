<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Account extends Model implements AuthenticatableContract
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
    protected $rememberTokenName = 'acc_remember';

    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->acc_password;
    }

    public function getRememberToken()
    {
        if (! empty($this->getRememberTokenName())) {
            return (string) $this->{$this->getRememberTokenName()};
        }
    }

    public function setRememberToken($value)
    {
        if (! empty($this->getRememberTokenName())) {
            $this->{$this->getRememberTokenName()} = $value;
        }
    }

    public function getRememberTokenName()
    {
        return $this->rememberTokenName;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['acc_password'] = bcrypt($value);
    }

    public function billExs()
    {
        return $this->hasMany('App\BillExport', 'acc_id', 'acc_id');
    }

    public function billIms()
    {
        return $this->hasMany('App\billIm', 'acc_id', 'acc_id');
    }

    public function address()
    {
        return $this->hasMany('App\Address', 'acc_id', 'acc_id');
    }
}
