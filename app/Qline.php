<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qline extends Model
{
    protected $fillable = [
             'quote_id',
             'line_no',
             'item_no',
             'item_detail',
             'spec1',
             'spec2',
             'spec3',
             'spec4',
             'spec5',
             'spec6',
             'spec7',
             'spec8',
             'spec9',
             'spec10',
             'spec11',
             'spec12',
             'spec13',
             'spec14',
             'spec15',
             'item_notes',
             'item_type',
             'line_status',
             'quantity',
             'cost', 
             'commission',
             'supp_ref',
             'price', 
             'value',
             'updated_by',
    ];


     public function quote()
    {
        return $this->belongsTo('App\Quote');
    }

    
/*
    public function getPriceAttribute()
    {

         return number_format($this->attributes['price'], 2,".",",");
    }

    public function getValueAttribute()
    {

         return number_format($this->attributes['value'], 2,".",",");
    }
    

*/

}
