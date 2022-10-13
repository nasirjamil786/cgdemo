<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_title', 'first_name', 'last_name','name','position','address1','address2',
        'area', 'town', 'county','postcode','country','phone','mobile','tax_no',
        'user_status', 'notes', 'ipaddress','login_device','email','password',
        'password_hint', 'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    


    public function roles(){

        return $this->belongsToMany(Role::class);
    }

    // public function hasRole($role_name){
    //
    //    foreach($this->roles as $role){
    //        if($role->name == $role_name) return true;
    //    }
    //    return false;
    //}


    public function hasRole($role){

        if(is_string($role)){
            return $this->roles->contains('name',$role);
        }

        foreach($role as $r){
            if($this->hasRole($r->name)){

                return true;
            }
        }

        return false;

        //return !! $role->intersect($this->roles())->count();

    }

    //input role may be role id or role object
    public function assignRole($role){

        return $this->roles()->attach($role);
    }

    //input role may be role id or role object
    public function removeRole($role){

        return $this->roles()->detach($role);
    }

    //input role must be an array of role id/ids
    public function updateRole($role){
        return $this->roles()->sync($role);
    }

    public function isSuperAdmin(){

        if($this->hasRole("Admin")){
            return true;
        }
        return false;
    }


    public function bookings()
    {
        return $this->hasMany('App\Booking','assigned_to','id');
    }
    
}
