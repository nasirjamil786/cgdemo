<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orline extends Model
{

    protected $fillable = ['order_id',
        'line_no',
        'item_no',
        'item_detail',
        'item_notes',
        'line_status',
        'quantity',
        'price',
        'cost',
        'value',
        'commission',
        'updated_by'
    ];


    public function order()
    {
        return $this->belongsTo('App\Order');
    }


    public function getValueAttribute($value)
    {
        return ucfirst($value);
    }
    


}
