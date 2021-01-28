<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RelatedImage extends Model
{
    public $timestamps = false;
    protected $table = 'related_image';
    protected $fillable = ['reimg_name'];   //Cho phep sua trong cac truong nay
    protected $guarded = ['pro_id','reimg_stt']; //cot duoc bao ve
    protected $primaryKey = ['pro_id','reimg_stt'];
    public    $incrementing = false;

    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
