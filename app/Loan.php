<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
  protected $primaryKey='loan_id';
  protected $fillable = [
    'loan_amount',
    'loan_start_date',
    'loan_type',
    'loan_description',
    'loan_finished',
    'loan_deactivated',
    'loan_end_date',
    'loan_documentcharges',
    'loan_customer_id',
    'loan_branch_id',
    'loan_center_id'

  ];



public function customer(){
   return $this->belongsTo('App\Customer','loan_customer_id');
   }

   public function center(){
      return $this->belongsTo('App\Center','loan_center_id');
      }

      public function branch(){
         return $this->belongsTo('App\Branch');
         }

   public function installment(){
           return $this->hasOne('App\Installment','installment_loan_id');
       }

       public function historyofloans(){
               return $this->hasMany('App\HistoryOfLoan');
           }

       public function comments()
       {
           return $this->morphMany('App\Comment', 'commentable');
       }

}
