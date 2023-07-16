<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;
use Carbon\Carbon;

class Customer extends Model
{
    protected $fillable = ['cust_title','first_name','last_name','company','address1','address2',
    'town','postcode','county','country','email','ccemail','phone','mobile','recommended_by','recommended_name',
    'cust_type','outstand_balance','account_total','discount','status','newsletter','notes','updated_by',
    'old_ref','user_id','belongs_to','subscription_status','send_email','revreqsent','reviewed'
    ];

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    //Relationship with Orders

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }


    public function getFirstNameAttribute($value){

        return ucfirst($value);

     }
    public function getLastNameAttribute($value){

        return ucfirst($value);

    }
    public function getCompanyAttribute($value){

        return ucfirst($value);
    }
    public function getAddress1Attribute($value){

        return ucfirst($value);
    }
    public function getAddress2Attribute($value){

        return ucfirst($value);
    }
    public function getAreaAttribute($value){

        return ucfirst($value);
    }
    public function getTownAttribute($value){

    return ucfirst($value);
    }
    public function getCountyAttribute($value){

        return ucfirst($value);
    }
    public function getCountryAttribute($value){

        return ucfirst($value);
    }
    public function getRecommendedByAttribute($value){

        return ucfirst($value);
    }
    public function getPOSTCODEAttribute($value){

        return strtoupper($value);
    }
    public function getReviewedAttribute($value)
    {
        //database date 2016-05-15
        if($value != null)
           $value = DateTime::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');

        return $value; //return  15/05/2016
    }
    
}
