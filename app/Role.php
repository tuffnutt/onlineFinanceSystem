<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $fillable = [
    'role_name'


  ];

  public function users(){
          return $this->hasMany('App\User');
      }

  public function comments()
  {
      return $this->morphMany('App\Comment', 'commentable');
  }

}
