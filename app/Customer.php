<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $primaryKey='customer_id';
  protected $fillable = [

    'customer_name',
    'customer_name_with_initials',
    'customer_address',
    'customer_nic',
    'customer_occupancy',
    'customer_mobile',
    'customer_landline',
    'customer_business_phone',
    'customer_savings',
    'customer_insuarance',
    'customer_birthday',
    'customer_grouped',
    'customer_marital_status',
    'customer_status',
    'customer_income',
    'customer_other_bonds',
    'customer_business',
    'customer_employer_name',
    'customer_designation',
    'customer_special_abilities',
    'customer_spouse_name',
    'customer_spouse_address',
    'customer_spouse_nic',
    'customer_spouse_telephone',
    'customer_spouse_relationship',
    'customer_spouse_birthday',
    'customer_spouse_business',
    'customer_spouse_employer_name',
    'customer_spouse_designation',
    'customer_spouse_special_abilities',
    'customer_center_id',
    'customer_branch_id',
    'customer_group_id'

  ];

public function center(){
   return $this->belongsTo('App\Center');
   }
   public function branch(){
      return $this->belongsTo('App\Branch');
      }

   public function loan(){
        return $this->hasOne('App\Loan','loan_customer_id');
    }
    public function group(){
         return $this->belongsTo('App\Group');
     }
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
