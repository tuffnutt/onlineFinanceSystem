<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  protected $primaryKey='group_id';
  protected $fillable = [
    'group_center_id'

  ];



public function customers(){
   return $this->hasMany('App\User','customer_id');
   }


public function center(){
   return $this->belongsTo('App\Center');
   }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
