<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = ['booking_date','booking_time','name','phone','address','town',
    'postcode','email','assigned_to','booked_by','updated_by','event_id'
    ];



    public function engineer()
    {
        return $this->belongsTo('App\User','assigned_to','id');
    }

    public function bookedby()
    {
        return $this->belongsTo('App\User','booked_by','id');
    }



     public function getBookingDateAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
           $value = DateTime::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');

        return $value; //return  15/05/2016
    }

    public function getBookingTimeAttribute($value)
    {
        //database time 12:30:00
        if($value != null)
            $value = substr($value, 0,5);

        return $value; //return  12:30
    }
    
}
