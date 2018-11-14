<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Branch;
use App\Customer;
use App\Center;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{


  /**
   * return center loan details.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function deactivate(Request $request)
  {
$lid=intval($request->input('loan_id'));
    $loan=Loan::where('loan_id',$lid)->get()->first();
    $loanUpdate = Loan::where('loan_id', $loan->loan_id)
                           ->update([
                            // 'loan_amount' => $request->input('amount'),
                            // 'loan_start_date' => $request->input('start'),
                             //'loan_type' => $request->input('type'),
                             'loan_description' =>($request->input('discription')),
                             //'loan_finished' => true,
                            'loan_deactivated' => true
                             //'loan_end_date' => today()
                            // 'loan_documentcharges' => $request->input('documentcharge'),
                            // 'loan_customer_id' => $request->input('customer')

                           ]);
app('App\Http\Controllers\CustomersController')->finishloanstatus(Customer::find($loan->loan_customer_id));
if((Auth::user()->user_role_id<3)){
  $loans = Loan::all();
}else if((Auth::user()->user_role_id<4)){
  $branch=Branch::where('branch_id',Auth::user()->branch_id)->first()->get();
  $customers=Customer::where('customer_branch_id',$branch->branch_id)->get();
  $loans = Loan::where('loan_customer_id',$customers->customer_id)->get();
}else {
  $centers=Center::where('center_user_id',Auth::user()->id)->get();
  $customers=Customer::where('customer_center_id',$centers->center_id)->get();
  $loans = Loan::where('loan_customer_id',$customers->customer_id)->get();
}

   return view('loans.index', ['loans'=> $loans]);

  }



  /**
   * return center loan details.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function repayment(Request $request)
  {
    $count=intval($request->input('count'));

    app('App\Http\Controllers\PaymentsController')->init();
    $pid= Payment::all()->last();



    while($count>0){
    $lid=intval($request->input("$count"));
    $amount=floatval($request->input("a".$lid));
     app('App\Http\Controllers\InstallmentsController')->insert($lid,$amount,$pid->payment_id);
     app('App\Http\Controllers\PaymentsController')->insert($pid,$amount);
     app('App\Http\Controllers\HistoryOfLoansController')->insert(Loan::find($lid),$pid,$amount);

     $count=$count-1;

    }
      if((Auth::user()->user_role_id<3)){
        $centers = Center::all();
      }else if((Auth::user()->user_role_id<4)){
        $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
      }else {
        $centers = Center::where('center_user_id',Auth::user()->id)->get();
      }
      $loans=Loan::where('loan_id',0)->get();
       return view('loans.loanUpdate', ['centers'=> $centers,'loans'=> $loans]);



  }
  /**
   * return center loan details.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function loadcenter(Request $request)
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
         $loans = Loan::where('loan_center_id',$center->center_id)->get();


        //

         return view('loans.loanUpdate', ['loans'=> $loans,'centers'=>$centers]);
    }
    return view('auth.login');
  }



  public function loanUpdate()
  {

      if( Auth::check() ){

        if((Auth::user()->user_role_id<3)){
          $centers = Center::all();
        }else if((Auth::user()->user_role_id<4)){
          $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
        }else {
          $centers = Center::where('center_user_id',Auth::user()->id)->get();
        }
        $loans=Loan::where('loan_id',0)->get();
         return view('loans.loanUpdate', ['centers'=> $centers,'loans'=> $loans]);
    }
    return view('auth.login');
  }




  public function finished(Loan $loan)
  {
    $loanUpdate = Loan::where('loan_id', $loan->loan_id)
                           ->update([
                            // 'loan_amount' => $request->input('amount'),
                            // 'loan_start_date' => $request->input('start'),
                             //'loan_type' => $request->input('type'),
                             //'loan_description' => $request->input('description'),
                             'loan_finished' => true,
                            // 'loan_deactivated' => $request->input('deactivated'),
                             'loan_end_date' => today()
                            // 'loan_documentcharges' => $request->input('documentcharge'),
                            // 'loan_customer_id' => $request->input('customer')

                           ]);

                           app('App\Http\Controllers\CustomersController')->finishloanstatus(Customer::find($loan->loan_customer_id));


  }

  public function deactivated(Loan $loan,$discription)
  {
    $loanUpdate = Loan::where('loan_id', $loan->loan_id)
                           ->update([
                            // 'loan_amount' => $request->input('amount'),
                            // 'loan_start_date' => $request->input('start'),
                             //'loan_type' => $request->input('type'),
                             'loan_description' =>$discription,
                             //'loan_finished' => true,
                            'loan_deactivated' => true
                             //'loan_end_date' => today()
                            // 'loan_documentcharges' => $request->input('documentcharge'),
                            // 'loan_customer_id' => $request->input('customer')

                           ]);
app('App\Http\Controllers\CustomersController')->finishloanstatus(Customer::find($loan->loan_customer_id));
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if( Auth::check() ){

          if((Auth::user()->user_role_id<3)){
            $loans = Loan::all();
          }else if((Auth::user()->user_role_id<4)){
            $branch=Branch::where('branch_id',Auth::user()->branch_id)->first()->get();
            $customers=Customer::where('customer_branch_id',$branch->branch_id)->get();
            $loans = Loan::where('loan_customer_id',$customers->customer_id)->get();
          }else {
            $centers=Center::where('center_user_id',Auth::user()->id)->get();
            $customers=Customer::where('customer_center_id',$centers->center_id)->get();
            $loans = Loan::where('loan_customer_id',$customers->customer_id)->get();
          }

             return view('loans.index', ['loans'=> $loans]);
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

          $customers=Customer::all();

        }else if((Auth::user()->user_role_id<4)){

          $customers=Customer::where('customer_branch_id',Auth::user()->user_branch_id)->get();


        }else {

          $customers=Customer::where('customer_center_id',Center::where('center_branch_id',Auth::user()->branch_id)->branch_center_id)->get();

        }

           return view('loans.create', ['customers'=>$customers]);
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
      $c1=$request->input('customer');
      $doc=floatval($request->input('amount'))*0.01;
      $customer=Customer::find($c1);
      if(Auth::check()){
          $loan = Loan::create([
            'loan_amount' => $request->input('amount'),
            'loan_start_date' => $request->input('startdate'),
            //'loan_type' => $request->input('type'),
            //'loan_description' => $request->input('description'),
            //'loan_finished' => $request->input('finished'),
            //'loan_deactivated' => $request->input('deactivated'),
            //'loan_end_date' => $request->input('end'),
            'loan_documentcharges' => $doc,
            'loan_center_id' => $customer->customer_center_id,
            'loan_branch_id' =>$customer->customer_branch_id,
            'loan_customer_id' => $c1
          ]);
            app('App\Http\Controllers\CustomersController')->loanstatus(Customer::find($c1));
            app('App\Http\Controllers\CustomersController')->saving(Customer::find($c1),$doc);
            app('App\Http\Controllers\InstallmentsController')->init(Loan::find($loan->loan_id));


          if($loan){
              return redirect()->route('loans.show', ['loan'=> $loan->loan_id])
              ->with('success' , 'Loan created successfully');
          }

      }

          return back()->withInput()->with('errors', 'Error creating new loan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
      $loan = Loan::find($loan->loan_id);

      return view('loans.show', ['loan'=>$loan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
      $loan = Loan::find($loan->loan_id);

      return view('loans.edit', ['loan'=>$loan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
      $loanUpdate = Loan::where('loan_id', $loan->loan_id)
                             ->update([
                               'loan_amount' => $request->input('amount'),
                               'loan_start_date' => $request->input('start'),
                               //'loan_type' => $request->input('type'),
                               'loan_description' => $request->input('description'),
                               'loan_finished' => $request->input('finished'),
                               'loan_deactivated' => $request->input('deactivated'),
                               'loan_end_date' => $request->input('end'),
                               'loan_documentcharges' => $request->input('documentcharge'),
                               'loan_customer_id' => $request->input('customer')

                             ]);

   if($loanUpdate){
       return redirect()->route('loans.show', ['loan'=> $loan->loan_id])
       ->with('success' , 'Loan updated successfully');
   }
   //redirect
   return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
      $findLoan = Loan::find( $loan->loan_id);
  if($findLoan->delete()){

          //redirect
          return redirect()->route('loans.index')
          ->with('success' , 'Loan deleted successfully');
      }

      return back()->withInput()->with('error' , 'Loan could not be deleted');
    }
}
