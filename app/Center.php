<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
  protected $primaryKey='center_id';
  protected $fillable = [
    'center_name',
    'center_address',
    'center_collect_day',
    'center_user_id',
    'center_branch_id'

  ];



public function user(){
   return $this->belongsTo('App\User');
   }


public function branch(){
   return $this->belongsTo('App\Branch');
   }

public function groups(){
           return $this->hasMany('App\Group');
       }

       public function transactions(){
                  return $this->hasMany('App\Transaction','transaction_id');
              }

       public function loans(){
                  return $this->hasMany('App\Loan','loan_id');
              }

 public function comments()
       {
           return $this->morphMany('App\Comment', 'commentable');
       }

}
