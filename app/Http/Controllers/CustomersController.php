<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Center;
use App\Branch;
use App\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

     public function withdraw(Request $request){

       $amount=floatval($request->input('amount'));
       $cid=intval($request->input('cid'));
       $customer=Customer::find($cid);

        $customerUpdate = Customer::where('customer_id', $customer->customer_id)
                               ->update([

                                 'customer_savings'=> ($customer->customer_savings)-$amount

                               ]);

                               if((Auth::user()->user_role_id<3)){
                                 $centers = Center::all();
                               }else if((Auth::user()->user_role_id<4)){
                                 $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
                               }else {
                                 $centers = Center::where('center_user_id',Auth::user()->id)->get();
                               }
                               $customers=Customer::where('customer_id',0)->get();
                                return view('customers.savingsWithdraw', ['centers'=> $centers,'customers'=> $customers]);

     }


     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */

        public function inswithdraw(Request $request){

          $amount=floatval($request->input('amount'));
          $cid=intval($request->input('cid'));
          $customer=Customer::find($cid);

           $customerUpdate = Customer::where('customer_id', $customer->customer_id)
                                  ->update([

                                    'customer_insuarance'=> ($customer->customer_insuarance)-$amount

                                  ]);
                                  if((Auth::user()->user_role_id<3)){
                                    $centers = Center::all();
                                  }else if((Auth::user()->user_role_id<4)){
                                    $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
                                  }else {
                                    $centers = Center::where('center_user_id',Auth::user()->id)->get();
                                  }
                                  $customers=Customer::where('customer_id',0)->get();
                                   return view('customers.insuaranceWithdraw', ['centers'=> $centers,'customers'=> $customers]);
        }




        public function savingsWithdraw()
        {

            if( Auth::check() ){

              if((Auth::user()->user_role_id<3)){
                $centers = Center::all();
              }else if((Auth::user()->user_role_id<4)){
                $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
              }else {
                $centers = Center::where('center_user_id',Auth::user()->id)->get();
              }
              $customers=Customer::where('customer_id',0)->get();
               return view('customers.savingsWithdraw', ['centers'=> $centers,'customers'=> $customers]);
          }
          return view('auth.login');
        }




        public function insuaranceWithdraw()
        {

            if( Auth::check() ){

              if((Auth::user()->user_role_id<3)){
                $centers = Center::all();
              }else if((Auth::user()->user_role_id<4)){
                $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
              }else {
                $centers = Center::where('center_user_id',Auth::user()->id)->get();
              }
              $customers=Customer::where('customer_id',0)->get();
               return view('customers.insuaranceWithdraw', ['centers'=> $centers,'customers'=> $customers]);
          }
          return view('auth.login');
        }

        public function insUpdate()
        {

            if( Auth::check() ){

              if((Auth::user()->user_role_id<3)){
                $centers = Center::all();
              }else if((Auth::user()->user_role_id<4)){
                $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
              }else {
                $centers = Center::where('center_user_id',Auth::user()->id)->get();
              }
              $customers=Customer::where('customer_id',0)->get();
               return view('customers.insUpdate', ['centers'=> $centers,'customers'=> $customers]);
          }
          return view('auth.login');
        }


        /**
         * return center loan details.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function loadcentersavings(Request $request)
        {
          $cid=$request->input('center');
          if( Auth::check() ){

            if((Auth::user()->user_role_id<3)){
              $centers = Center::all();
            }else if((Auth::user()->user_role_id<4)){
              $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
            }else {
              $centers = Center::where('center_user_id',Auth::user()->id)->get();
            }


              $center=Center::find($cid);
               $customers = Customer::where('customer_center_id',$center->center_id)->get();


              //

               return view('customers.savingsWithdraw', ['customers'=> $customers,'centers'=>$centers]);
          }
          return view('auth.login');
        }



        /**
         * return center loan details.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function loadcenterinsupdate(Request $request)
        {
          $cid=$request->input('center');
          if( Auth::check() ){

            if((Auth::user()->user_role_id<3)){
              $centers = Center::all();
            }else if((Auth::user()->user_role_id<4)){
              $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
            }else {
              $centers = Center::where('center_user_id',Auth::user()->id)->get();
            }
            $center=Center::find($cid);
             $customers = Customer::where('customer_center_id',$center->center_id)->get();

             return view('customers.insUpdate', ['centers'=> $centers,'customers'=> $customers]);
          }
          return view('auth.login');
        }



        /**
         * return center loan details.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function insuarancerepayment(Request $request)
        {
          $count=intval($request->input('count'));





          while($count>0){
          $cid=intval($request->input("$count"));
          $c1=Customer::where('customer_id',$cid)->get()->first();
          $amount=floatval($request->input("a".$cid));
          $customerUpdate = Customer::where('customer_id', $cid)
                                 ->update([

                                   'customer_insuarance'=> $c1->customer_insuarance+$amount

                                 ]);

           $count=$count-1;

          }
            if((Auth::user()->user_role_id<3)){
              $centers = Center::all();
            }else if((Auth::user()->user_role_id<4)){
              $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
            }else {
              $centers = Center::where('center_user_id',Auth::user()->id)->get();
            }
            $customers=Customer::where('customer_id',0)->get();
             return view('customers.insUpdate', ['centers'=> $centers,'customers'=> $customers]);



        }




        /**
         * return center loan details.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function loadcenterinsuarance(Request $request)
        {
          $cid=$request->input('center');
          if( Auth::check() ){

            if((Auth::user()->user_role_id<3)){
              $centers = Center::all();
            }else if((Auth::user()->user_role_id<4)){
              $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
            }else {
              $centers = Center::where('center_user_id',Auth::user()->id)->get();
            }


            $center=Center::find($cid);
             $customers = Customer::where('customer_center_id',$center->center_id)->get();


            //

             return view('customers.insuaranceWithdraw', ['customers'=> $customers,'centers'=>$centers]);
          }
          return view('auth.login');
        }




     public function saving(Customer $customer,$amount){


        $customerUpdate = Customer::where('customer_id', $customer->customer_id)
                               ->update([

                                 'customer_savings'=> $customer->customer_savings+$amount

                               ]);

     }


     public function grouped(Customer $customer,$groupid){


        $customerUpdate = Customer::where('customer_id', $customer->customer_id)
                               ->update([

                                 'customer_grouped'=> true,
                                 'customer_group_id'=> $groupid

                               ]);

     }

     public function ungrouped(Customer $customer){


        $customerUpdate = Customer::where('customer_id', $customer->customer_id)
                               ->update([

                                 'customer_grouped'=> false,
                                 'customer_group_id'=> null


                               ]);

     }

     public function loanstatus(Customer $customer){


        $customerUpdate = Customer::where('customer_id', $customer->customer_id)
                               ->update([

                                 'customer_status'=> true

                               ]);

     }

     public function finishloanstatus(Customer $customer){


        $customerUpdate = Customer::where('customer_id', $customer->customer_id)
                               ->update([

                                 'customer_status'=> false

                               ]);

     }



    public function index()
    {
      if( Auth::check() ){

        if((Auth::user()->user_role_id<3)){
          $customers = Customer::all();

        }else if((Auth::user()->user_role_id<4)){

          $customers = Customer::where('customer_branch_id',Auth::user()->user_branch_id)->get();

        }else{

          $customers = Customer::where('customer_branch_id',Auth::user()->user_branch_id)->get();

        }
           return view('customers.index', ['customers'=> $customers]);
      }
      return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if( Auth::check() ){

        if((Auth::user()->user_role_id<3)){
          $centers = Center::all();
          $branches=Branch::all();
        }else   if((Auth::user()->user_role_id<4)){
          $centers=Center::Where('center_branch_id',Auth::user()->user_branch_id)->get();
          $branches=Branch::all();
        }else{
          $centers=Center::Where('center_user_id',Auth::user()->id)->get();
          $branches=Branch::all();
        }
           return view('customers.create', ['centers'=> $centers,'branches'=> $branches]);
      }
      return view('auth.login');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(Auth::check()){
          $customer = Customer::create([

            'customer_name'=> $request->input('name'),
            'customer_name_with_initials'=> $request->input('namewithinitials'),
            'customer_address'=> $request->input('address'),
            'customer_nic'=> $request->input('nic'),
            'customer_occupancy'=> $request->input('occupancy'),
            'customer_mobile'=> $request->input('mobile'),
            'customer_landline'=> $request->input('landline'),
            'customer_business_phone'=> $request->input('businessphone'),
            //'customer_savings'=> $request->input('savings'),
            'customer_birthday'=> $request->input('birthday'),
            //'customer_grouped'=> $request->input('grouped'),
            'customer_marital_status'=> $request->input('marital'),
          //  'customer_status'=> $request->input('status'),
            'customer_income'=> $request->input('income'),
            'customer_other_bonds'=> $request->input('otherbonds'),
            'customer_business'=> $request->input('business'),
            'customer_employer_name'=> $request->input('employername'),
            'customer_designation'=> $request->input('designation'),
            'customer_special_abilities'=> $request->input('specialabilities'),
            'customer_spouse_name'=> $request->input('spousename'),
            'customer_spouse_address'=> $request->input('spouseaddress'),
            'customer_spouse_nic'=> $request->input('spousenic'),
            'customer_spouse_telephone'=> $request->input('spousetelephone'),
            'customer_spouse_relationship'=> $request->input('spouserelationship'),
            'customer_spouse_birthday'=> $request->input('spousebirthday'),
            'customer_spouse_business'=> $request->input('spousebusiness'),
            'customer_spouse_employer_name'=> $request->input('spouseemployername'),
            'customer_spouse_designation'=> $request->input('spousedesignation'),
            'customer_spouse_special_abilities'=> $request->input('spousespecialabilities'),
            'customer_center_id'=> $request->input('centerid'),
            'customer_branch_id'=> $request->input('branchid')

          ]);


          if($customer){
              return redirect()->route('customers.show', ['Customer'=> $customer->customer_id])
              ->with('success' , 'Customer created successfully');
          }
        }

            return back()->withInput()->with('errors', 'Error creating new customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
      $customer = Customer::find($customer->customer_id);

      return view('customers.show', ['customer'=>$customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
      $customer = Customer::find($customer->customer_id);

      return view('customers.edit', ['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
      $customerUpdate = Customer::where('customer_id', $customer->customer_id)
                             ->update([



                               'customer_name'=> $request->input('name'),
                               'customer_name_with_initials'=> $request->input('namewithinitials'),
                               'customer_address'=> $request->input('address'),
                               'customer_nic'=> $request->input('nic'),
                               'customer_occupancy'=> $request->input('occupancy'),
                               'customer_mobile'=> $request->input('mobile'),
                               'customer_landline'=> $request->input('landline'),
                               'customer_business_phone'=> $request->input('businessphone'),
                               'customer_savings'=> $request->input('savings'),
                               'customer_birthday'=> $request->input('birthday'),
                               'customer_grouped'=> $request->input('grouped'),
                               'customer_marital_status'=> $request->input('marital'),
                               'customer_status'=> $request->input('status'),
                               'customer_income'=> $request->input('income'),
                               'customer_other_bonds'=> $request->input('otherbonds'),
                               'customer_business'=> $request->input('business'),
                               'customer_employer_name'=> $request->input('employername'),
                               'customer_designation'=> $request->input('designation'),
                               'customer_special_abilities'=> $request->input('specialabilities'),
                               'customer_spouse_name'=> $request->input('spousename'),
                               'customer_spouse_address'=> $request->input('spouseaddress'),
                               'customer_spouse_nic'=> $request->input('spousenic'),
                               'customer_spouse_telephone'=> $request->input('spousetelephone'),
                               'customer_spouse_relationship'=> $request->input('spouserelationship'),
                               'customer_spouse_birthday'=> $request->input('spousebirthday'),
                               'customer_spouse_business'=> $request->input('spousebusiness'),
                               'customer_spouse_employer_name'=> $request->input('spouseemployername'),
                               'customer_spouse_designation'=> $request->input('spousedesignation'),
                               'customer_spouse_special_abilities'=> $request->input('spousespecialabilities'),
                               'customer_center_id'=> $request->input('centerid')

                             ]);

   if($customerUpdate){
       return redirect()->route('customers.show', ['customer'=> $customer->customer_id])
       ->with('success' , 'Customer updated successfully');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
      $findCustomer = Customer::find( $customer->customer_id);
  if($findCustomer->delete()){

          //redirect
          return redirect()->route('customers.index')
          ->with('success' , 'Customer deleted successfully');
      }

      return back()->withInput()->with('error' , 'Customer could not be deleted');

  }
    }
