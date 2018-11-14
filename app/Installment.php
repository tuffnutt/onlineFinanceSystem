<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
  protected $primaryKey='installment_id';
  protected $fillable = [
    'installment_total',
    'installment_per_week',
    'installment_balance',
    'installment_last_payment',
    'installment_add',
    'installment_areas',
    'installment_count',
    'installment_last_payment_date',
    'd1',
    'd2',
    'd3',
    'd4',
    'd5',
    'd6',
    'd7',
    'd8',
    'd9',
    'd10',
    'd11',
    'd12',
    'd13',
    'd14',
    'd15',
    'a1',
    'a2',
    'a3',
    'a4',
    'a5',
    'a6',
    'a7',
    'a8',
    'a9',
    'a10',
    'a11',
    'a12',
    'a13',
    'installment_loan_id'

  ];




public function loan(){
   return $this->belongsTo('App\Loan');
   }

}
