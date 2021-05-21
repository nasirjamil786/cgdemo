<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [

            'customer_id',
            'cust_name',
            'order_id',
            'quote_id',
            'payment_date',
            'amount',
            'payment_method',
            'payment_ref',
            'payment_type',
            'detail',
            'currency',
            'exch_rate',
            'updated_by',

    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
