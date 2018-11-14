<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $primaryKey='payment_id';
  protected $fillable = [

    'payment_amount',
    'payment_date'

  ];

  public function historyofloans(){
          return $this->hasMany('App\HistoryOfLoan');
      }

  public function comments()
  {
      return $this->morphMany('App\Comment', 'commentable');
  }

}
