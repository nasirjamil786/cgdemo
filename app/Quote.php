<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Carbon\Carbon;

class Quote extends Model
{
    protected $fillable = [
    	     'customer_id',
             'quote_date',
             'valid_date',
             'email_sent',
             'quote_status',
             'work_detail',
             'line_total', 
             'discount_percent',
             'discount', 
             'delivery_charges', 
             'total_beforevat', 
             'vat_rate', 
             'vat', 
             'quote_total', 
             'updated_by',
             'order_id',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


     public function qline()
    {
        return $this->hasMany('App\Qline');
    }


    public function getValidDateAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
           $value = DateTime::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');

        return $value; //return  15/05/2016
    }

    public function getQuoteDateAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
           $value = DateTime::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');

        return $value; //return  15/05/2016
    }



}
