<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
  protected $primaryKey='branch_id';
  protected $fillable = [
      'branch_name',
      'branch_address',
      'branch_telephone'

  ];
  public function centers(){
        return $this->hasMany('App\Center');
    }
    public function loans(){
               return $this->hasMany('App\Loan','loan_id');
           }

    public function users(){
          return $this->hasMany('App\User');
      }

      public function customers(){
            return $this->hasMany('App\Customer');
        }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
