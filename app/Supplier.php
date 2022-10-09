<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    
    protected $fillable = ['name','email','phone','mobile','website','username','password','account','notes'];

    public $incrementing = true;
}
