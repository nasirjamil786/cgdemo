<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use Carbon\Carbon;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'supp_id',
        'invno',
        'inv_date',
        'vatno',
        'suppname',
        'filename',
        'linetotal', 
        'discount',
        'delivery', 
        'subtotal', 
        'vatrate', 
        'vat', 
        'total', 
        'updated_by',
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function getInvDateAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
           $value = DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y');

        return $value; //return  15/05/2016
    }

}
