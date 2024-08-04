<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'reg_no','vat','vat_no','vat_rate','address1',
        'address2','area','town','postcode','country','phone',
        'mobile','email','web','logo_file','updated_by'
    ];

}
