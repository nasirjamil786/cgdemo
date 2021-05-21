<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['name', 'label'];

    public function roles(){

        return $this->belongsToMany(Role::class);
    }


    public function hasRole($role){
        return $this->roles->contains('name',$role);
    }
}
