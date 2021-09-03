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
'delivery_charges','total_beforevat', 'vat_rate','vat','order_total','payment_date','payment','payment_method','payment_ref','send_email','email_sent','quote_id','event_id','test_startup','test_startup_comm','test_sound','test_sound_comm','test_camera','test_camera_comm','test_wifi','test_wifi_comm','test_ethernet','test_ethernet_comm','test_keyboard','test_keyboard_comm','test_trackpad','test_trackpad_comm','test_headphone','test_headphone_comm','test_display','test_display_comm','test_homebutton','test_homebutton_comm','test_microphone','test_microphone_comm','test_fan','test_fan_comm','test_battery','test_battery_comm','test_chport','test_chport_comm','test_shutdown','test_shutdown_comm','test_earphone','test_earphone_comm','test_others','test_others_comm','test_date','tested_by'
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
