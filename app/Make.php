<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    protected $fillable = ['make'];


    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}
