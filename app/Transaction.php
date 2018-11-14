<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $primaryKey='transaction_id';
  protected $fillable = [
    'transaction_amount',
    'transaction_date',
    'transaction_lend',
    'transaction_user_id',
    'transaction_center_id'

  ];

public function user(){
   return $this->belongsTo('App\User','id');
   }

   public function center(){
      return $this->belongsTo('App\Center','center_id');
      }

}
