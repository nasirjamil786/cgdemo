<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = ['cust_id','order_ref','booking_date','booking_time','location','complete_date',
'collection_date','collection_time','followup_date','followup_time','order_status','device_type',
'make','model','serial_no','operating_system','condition','colour','data_backup','username','password',
'device_notes','estimate_parts','estimate_services','order_notes','work_detail','recommendations','payment_date',
'payment','payment_method','worked_by','taken_by','updated_by', 'line_total','discount_percent','discount',
'delivery_charges','total_beforevat', 'vat_rate','vat','order_total','payment_date','payment','payment_method','payment_ref','send_email','email_sent','quote_id','event_id'
    ];
    
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function takenby()
    {
        return $this->belongsTo('App\User');
    }

    public function workedby()
    {
        return $this->belongsTo('App\User','worked_by','id');
    }

    public function device()
    {
        return $this->belongsTo('App\Device');
    }

    public function make()
    {
        return $this->belongsTo('App\Make');
    }


    //Relationship with Orders

    public function orline()
    {
        return $this->hasMany('App\Orline');
    }

    //Accessors

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


    public function getCompleteDateAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
          $value = DateTime::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');
        return $value;
    }

    public function getCollectionDateAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
         $value = DateTime::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');
        return $value;
    }

    public function getCollectionTimeAttribute($value)
    {
        //database time 12:30:00
        if($value != null)
            $value = substr($value, 0,5);

        return $value; //return  12:30
    }


    public function getFollowupDateAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
          $value = DateTime::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');
        return $value;
    }

    public function getFollowupTimeAttribute($value)
    {
        //database time 12:30:00
        if($value != null)
            $value = substr($value, 0,5);

        return $value; //return  12:30
    }


    public function getPaymentDateAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
            $value = DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y');
        return $value;
    }

    
}
