<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        'user_first_name',
        'user_address',
        'user_nic',
        'user_mobile',
        'user_landline',
        'user_birthday',
        'user_marital_status',
        'user_role_id',
        'user_branch_id'
    ];

    public function role(){
       return $this->belongsTo('App\Role');
       }
       public function branch(){
          return $this->belongsTo('App\Branch');
          }

       public function centers(){
               return $this->hasMany('App\Center');
           }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
