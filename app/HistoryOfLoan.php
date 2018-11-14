<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryOfLoan extends Model
{
  protected $table = 'historyofloans';
  protected $primaryKey='historyofloan_id';
  protected $fillable = [
    'historyofloan_amount',
    'historyofloan_payment_id',
    'historyofloan_loan_id'

  ];



public function payment(){
   return $this->belongsTo('App\Payment');
   }


public function loan(){
   return $this->belongsTo('App\Loan');
   }
}
