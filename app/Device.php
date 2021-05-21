<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['device_type'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}
