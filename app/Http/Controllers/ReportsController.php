<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Center;
use App\Branch;
use App\Loan;
use App\payment;
use App\Installment;
use App\HistoryOfLoan;
use PdfReport;
use Hash;

class ReportsController extends Controller
{
  /**
   * Display a listing of the resource.
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

         return view('reports.create', ['customers'=>$customers]);
    }
    return view('auth.login');
  }


  public function displayReport(Request $request)
{
    //$fromDate = $request->input('from_date');
    //$toDate = $request->input('to_date');
    //$sortBy = $request->input('sort_by');
    $cid=intval($request->input('cid'));

    $title = 'Registered User Report'; // Report title

    $meta = [ // For displaying filters description on header
        'Registered on' => $cid
        //'Sort By' => $sortBy
    ];

    $queryBuilder = Customer::select(['customer_name', 'customer_nic', 'customer_id','customer_birthday']) // Do some querying..
                        ->where('customer_id',$cid);
                        //->orderBy($sortBy);

    $columns = [ // Set Column to be displayed
        'Name' => 'customer_name',
        'NIC'=>'customer_nic', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
        'CIF' => 'customer_id',
        'Status' =>'customer_id'
    ];



    // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
    $pdf = PdfReport::of($title, $meta, $queryBuilder, $columns)
                  //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                    //    'displayAs' => function($result) {
                  //          return $result->registered_at->format('d M Y');
                  //      },
                  //      'class' => 'left'
                  //  ])
                   ->editColumns(['Name', 'NIC','CIF','Status'], [ // Mass edit column
                       'class' => 'right bold'
                    ])
                  //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                    //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                  //  ])
                   ->limit(20) // Limit record to be showed
                   ->make()
                  ; // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

return $pdf ->stream('my.pdf',array('Attachment'=>false));

}


/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function showrepayment()
{
  if( Auth::check() ){

    if((Auth::user()->user_role_id<3)){

      $centers=Center::all();

    }else if((Auth::user()->user_role_id<4)){

      $centers=Center::where('center_branch_id',Auth::user()->user_branch_id)->get();


    }else {

    $centers=Center::where('center_user_id',Auth::user()->id)->get();

    }

       return view('reports.repayment', ['centers'=>$centers]);
  }
  return view('auth.login');
}




public function repayment(Request $request)
{
  //$fromDate = $request->input('from_date');
  //$toDate = $request->input('to_date');
  //$sortBy = $request->input('sort_by');
  $cid=intval($request->input('cid'));
  $center = Center::where('center_id',$cid)->get()->first();
  $title = 'Repayment sheet'; // Report title

  $meta = [ // For displaying filters description on header
      'Repayment sheet of' => $center->center_name
      //'Sort By' => $sortBy
  ];

  $queryBuilder = Loan::select(['loans.loan_id','groups.group_id','loans.loan_amount', 'loans.loan_customer_id','customers.customer_name','customers.customer_id','installments.installment_balance']) // Do some querying..
                      ->where('loan_center_id',$cid)
                        ->where('loan_finished',false)
                        ->where('loan_deactivated',false)
            ->join('installments', 'loans.loan_id', '=', 'installments.installment_loan_id')
            ->join('customers', 'loans.loan_customer_id', '=', 'customers.customer_id')
           ->join('groups', 'customers.customer_group_id', '=', 'groups.group_id');
          //  ->select('loans.*', 'installments.*', 'customers.*')
        //  ->orderBy('loans.loan_id')
          //->get() ;




  $columns = [ // Set Column to be displayed
      'Group' => 'group_id',
      'CIF'=>'customer_id', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
      'Name' => 'customer_name',
      'Amount' =>'loan_amount',
      'Due' =>'installment_balance',
      'New Loan' =>' ',
      'P1' =>' ',
      'P2' =>' ',
      'P3' =>' ',
      'P4' =>' ',
        'P5' =>' ',
          'P6' =>' '
  ];



  // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
  $pdf1 = PdfReport::of($title, $meta, $queryBuilder, $columns)
                //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                  //    'displayAs' => function($result) {
                //          return $result->registered_at->format('d M Y');
                //      },
                //      'class' => 'left'
                //  ])
                 ->editColumns(['Group', 'CIF','Name','Amount','Due','New Loan','P1','P2','P3','P4','P5','P6'], [ // Mass edit column
                     'class' => 'right bold'
                  ])
                //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                  //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                //  ])
                ->groupBy('Group')
                ->showTotal([
                    'Amount' => 'point',
                    'Due' => 'point'
                  ])
                ->setPaper('a4')
                ->setOrientation('landscape')


                 ->limit(10) // Limit record to be showed
                 ->make();
                 // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
return $pdf1 ->stream();
}









/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function showattendence()
{
  if( Auth::check() ){

    if((Auth::user()->user_role_id<3)){

      $centers=Center::all();

    }else if((Auth::user()->user_role_id<4)){

      $centers=Center::where('center_branch_id',Auth::user()->user_branch_id)->get();


    }else {

    $centers=Center::where('center_user_id',Auth::user()->id)->get();

    }

       return view('reports.attendence', ['centers'=>$centers]);
  }
  return view('auth.login');
}




public function attendence(Request $request)
{
  //$fromDate = $request->input('from_date');
  //$toDate = $request->input('to_date');
  //$sortBy = $request->input('sort_by');
  $cid=intval($request->input('cid'));
  $center = Center::where('center_id',$cid)->get()->first();
  $title = 'Attendence sheet'; // Report title

  $meta = [ // For displaying filters description on header
      'Attendence sheet of' => $center->center_name
      //'Sort By' => $sortBy
  ];

  $queryBuilder = Customer::select(['customer_id', 'customer_name','customer_group_id']) // Do some querying..
                      ->where('customer_center_id',$cid);
                      //->orderBy($sortBy);

  $columns = [ // Set Column to be displayed
      'Group' => 'customer_group_id',
      'CIF'=>'customer_id', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
      'Name' => 'customer_name',

      'P1' =>' ',
      'P2' =>' ',
      'P3' =>' ',
      'P4' =>' ',
        'P5' =>' ',
          'P6' =>' '
  ];



  // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
  $pdf = PdfReport::of($title, $meta, $queryBuilder, $columns)
                //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                  //    'displayAs' => function($result) {
                //          return $result->registered_at->format('d M Y');
                //      },
                //      'class' => 'left'
                //  ])
                 ->editColumns(['Group', 'CIF','Name','P1','P2','P3','P4','P5','P6'], [ // Mass edit column
                     'class' => 'right bold'
                  ])
                //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                  //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                //  ])
                ->groupBy('Group')

                ->setPaper('a4')
                ->setOrientation('landscape')


                 ->limit(10) // Limit record to be showed
                 ->make()
                ; // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

return $pdf ->stream('my.pdf',array('Attachment'=>false));

}




/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function showloanDetail()
{
  if( Auth::check() ){

    if((Auth::user()->user_role_id<3)){

      $branches=Branch::all();

    }else if((Auth::user()->user_role_id<4)){

      $branches=Branch::where('branch_id',Auth::user()->branch_id)->get();


    }else {

   $branches=Branch::where('branch_id',Auth::user()->branch_id)->get();

    }

       return view('reports.loanDetail', ['branches'=>$branches]);
  }
  return view('auth.login');
}




public function loanDetail(Request $request)
{
  //$fromDate = $request->input('from_date');
  //$toDate = $request->input('to_date');
  //$sortBy = $request->input('sort_by');
  $cid=intval($request->input('cid'));
  $center = Center::where('center_id',$cid)->get()->first();
  $title = 'Attendence sheet'; // Report title

  $meta = [ // For displaying filters description on header
      'Attendence sheet of' => $center->center_name
      //'Sort By' => $sortBy
  ];

  $queryBuilder = Customer::select(['customer_id', 'customer_name','customer_nic']) // Do some querying..
                      ->where('customer_center_id',$cid);
                      //->orderBy($sortBy);

  $columns = [ // Set Column to be displayed
      'Group' => 'customer_id',
      'CIF'=>'customer_id', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
      'Name' => 'customer_name',

      'P1' =>' ',
      'P2' =>' ',
      'P3' =>' ',
      'P4' =>' ',
        'P5' =>' ',
          'P6' =>' '
  ];



  // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
  $pdf = PdfReport::of($title, $meta, $queryBuilder, $columns)
                //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                  //    'displayAs' => function($result) {
                //          return $result->registered_at->format('d M Y');
                //      },
                //      'class' => 'left'
                //  ])
                 ->editColumns(['Group', 'CIF','Name','P1','P2','P3','P4','P5','P6'], [ // Mass edit column
                     'class' => 'right bold'
                  ])
                //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                  //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                //  ])
                ->setPaper('a4')
                ->setOrientation('landscape')


                 ->limit(10) // Limit record to be showed
                 ->make()
                ; // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

return $pdf ->stream('my.pdf',array('Attachment'=>false));

}






/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function showadvancedLoanDetail()
{
  if( Auth::check() ){

    if((Auth::user()->user_role_id<3)){

      $centers=Center::all();

    }else if((Auth::user()->user_role_id<4)){

      $centers=Center::where('center_branch_id',Auth::user()->user_branch_id)->get();


    }else {

    $centers=Center::where('center_user_id',Auth::user()->id)->get();

    }

       return view('reports.advancedLoanDetail', ['centers'=>$centers]);
  }
  return view('auth.login');
}




public function advancedLoanDetail(Request $request)
{
  //$fromDate = $request->input('from_date');
  //$toDate = $request->input('to_date');
  //$sortBy = $request->input('sort_by');
  $cid=intval($request->input('cid'));
  $center = Center::where('center_id',$cid)->get()->first();
  $title = 'Advanced Loan Detail Report'; // Report title

  $meta = [ // For displaying filters description on header
      'Advanced Loan Detail Report of' => $center->center_name
      //'Sort By' => $sortBy
  ];

  $queryBuilder = Loan::select(['loans.*','customers.*','installments.*']) // Do some querying..
                      ->where('loan_branch_id',$cid)
                      ->where('loan_finished',false)
                      ->where('loan_deactivated',false)
            ->join('installments', 'loans.loan_id', '=', 'installments.installment_loan_id')
            ->join('customers', 'loans.loan_customer_id', '=', 'customers.customer_id');


  $columns = [ // Set Column to be displayed
      'Group' => 'customer_group_id',
      'CIF'=>'customer_id', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
      'Name' => 'customer_name',

      'Amount' =>'loan_amount',
      'Total' =>'installment_total',
      'Balance' =>'installment_balance',
      'W Interest' =>'installment_add',
      'Areas Capital' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_balance-($result->loan_amount-(($result->installment_count-1)*$result->installment_per_week))) ;

        },
      'Interest < 13' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_count<13)?$result->installment_areas:$result->installment_add*13 ;


        },
      'Interest > 13' => function($result) { // You can do if statement or any action do you want inside this closure
          return ($result->installment_count>13)?$result->installment_areas:0.0;

        },

      'TL' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_count-1) ;
        },



      'Remain' => function($result) { // You can do if statement or any action do you want inside this closure
            return (14-$result->installment_count) ;
        }
  ];



  // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
  $pdf = PdfReport::of($title, $meta, $queryBuilder, $columns)
                //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                  //    'displayAs' => function($result) {
                //          return $result->registered_at->format('d M Y');
                //      },
                //      'class' => 'left'
                //  ])
                 ->editColumns(['Group', 'CIF','Name','Amount','Balance','Total','W Interest','Areas Capital',
                 'Interest > 13','Interest < 13','TL','Remain'], [ // Mass edit column
                     'class' => 'right bold'
                  ])
                //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                  //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                //  ])
                ->groupBy('Group')
                ->showTotal([
                    'Amount' => 'point',
                    'Balance' => 'point',
                    'Total' => 'point',
                    'Areas Capital' => 'point',
                      'Interest < 13'=> 'point',
                        'Interest > 13'=> 'point'
                  ])
                ->setPaper('a4')
                ->setOrientation('landscape')


                 ->limit(10) // Limit record to be showed
                 ->make()
                ; // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

return $pdf ->stream('my.pdf',array('Attachment'=>false));

}




/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function showloanSummary()
{
  if( Auth::check() ){

    if((Auth::user()->user_role_id<3)){

      $branches=Branch::all();

    }else if((Auth::user()->user_role_id<4)){

      $branches=Branch::where('branch_id',Auth::user()->branch_id)->get();


    }else {

   $branches=Branch::where('branch_id',Auth::user()->branch_id)->get();

    }

       return view('reports.loanSummary', ['branches'=>$branches]);
  }
  return view('auth.login');
}




public function loanSummary(Request $request)
{
  //$fromDate = $request->input('from_date');
  //$toDate = $request->input('to_date');
  //$sortBy = $request->input('sort_by');
  $cid=intval($request->input('cid'));
  $branch = Branch::where('branch_id',$cid)->get()->first();
  $title = 'Loan Summary Report'; // Report title

  $meta = [ // For displaying filters description on header
      'Loan Summary Report of' => $branch->branch_name
      //'Sort By' => $sortBy
  ];

  $queryBuilder = Loan::select(['loans.*','customers.*','installments.*','centers.*','users.*']) // Do some querying..
                      ->where('loan_branch_id',$cid)
                      ->where('loan_deactivated',false)
                      ->where('loan_finished',false)



            ->join('installments', 'loans.loan_id', '=', 'installments.installment_loan_id')
            ->join('customers', 'loans.loan_customer_id', '=', 'customers.customer_id')
            ->join('centers', 'loans.loan_center_id', '=', 'centers.center_id')
            ->join('users', 'centers.center_user_id', '=', 'users.id');


  $columns = [ // Set Column to be displayed
      'Group' => 'customer_group_id',
      'Center' => 'center_name',
      'Collect Day' =>'center_collect_day',
      'User' => 'name',
      'CIF'=>'customer_id', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
      'Name' => 'customer_name',

      'New' => function($result) { // You can do if statement or any action do you want inside this closure
        return ($result->installment_count==1)?1:'' ;

        },
      'New Amount' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_count==1)?$result->loan_amount:'' ;


        },
      'Active' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->loan_finished==false)?1:'' ;


        },
      'Active Amount' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->loan_finished==false)?$result->loan_amount:'' ;


        },
      'Outstanding' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_balance-$result->installment_add) ;

        },

        'Capital Outstanding' => function($result) { // You can do if statement or any action do you want inside this closure
              return ($result->installment_balance) ;

          },

          'Araes Amount At Today' => function($result) { // You can do if statement or any action do you want inside this closure
                return (($result->installment_count*$result->installment_per_week)-($result->loan_amount-$result->installment_balance)) ;


            },

      'Interest < 13' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_count<13)?$result->installment_areas:$result->installment_add*13 ;


        },
      'Interest > 13' => function($result) { // You can do if statement or any action do you want inside this closure
          return ($result->installment_count>13)?$result->installment_areas:0.0;

        },

      'Active Loan Week Term' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_last_payment) ;
        },



      'Defalt' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->loan_count>13)?1:'' ;
        },

        'Defalt Amount' => function($result) { // You can do if statement or any action do you want inside this closure
              return ($result->loan_count>13)?$result->loan_amount:'' ;
          }
      ];

      // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
      $pdf = PdfReport::of($title, $meta, $queryBuilder, $columns)
                    //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                      //    'displayAs' => function($result) {
                    //          return $result->registered_at->format('d M Y');
                    //      },
                    //      'class' => 'left'
                    //  ])
                    // ->editColumns(['Group', 'CIF','Name','Amount','Balance','Total','W Interest','Areas Capital',
                    // 'Interest > 13','Interest < 13','TL','Remain'], [ // Mass edit column
                    //     'class' => 'right bold'
                    //  ])
                    //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                      //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                    //  ])
                    ->groupBy('Center')
                    ->showTotal([
                        'New Amount' => 'point',
                        'New' => 'point',
                        'Active Amount' => 'point',
                        'Active' => 'point',
                        'Defalt' => 'point',
                        'Defalt Amount' => 'point',
                        'Active Loan Week Term'=> 'point',
                        'Araes Amount At Today'=> 'point',
                        'Capital Outstanding'=> 'point',
                        'Outstanding'=> 'point',

                        'Interest > 13' => 'point',
                        'Interest < 13' => 'point'

                    ])
                    ->setPaper('a4')
                    ->setOrientation('landscape')


                     ->limit(10) // Limit record to be showed
                     ->make()
                    ; // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

    return $pdf ->stream('my.pdf',array('Attachment'=>false));
}


/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function showdefaltLoan()
{
  if( Auth::check() ){

    if((Auth::user()->user_role_id<3)){

      $branches=Branch::all();

    }else if((Auth::user()->user_role_id<4)){

      $branches=Branch::where('branch_id',Auth::user()->branch_id)->get();


    }else {

   $branches=Branch::where('branch_id',Auth::user()->branch_id)->get();

    }

       return view('reports.defaltLoan', ['branches'=>$branches]);
  }
  return view('auth.login');
}




public function defaltLoan(Request $request)
{
  //$fromDate = $request->input('from_date');
  //$toDate = $request->input('to_date');
  //$sortBy = $request->input('sort_by');
  $cid=intval($request->input('cid'));
  $branch = Branch::where('branch_id',$cid)->get()->first();
  $title = 'Defalt Loan Detail Report'; // Report title

  $meta = [ // For displaying filters description on header
      'Defalt Loan Detail Report of' => $branch->branch_name
      //'Sort By' => $sortBy
  ];

  $queryBuilder = Loan::select(['loans.*','customers.*','installments.*','centers.*','users.*']) // Do some querying..
                      ->where('loan_branch_id',$cid)
                      ->where('installment_count','>',13)


            ->join('installments', 'loans.loan_id', '=', 'installments.installment_loan_id')
            ->join('customers', 'loans.loan_customer_id', '=', 'customers.customer_id')
            ->join('centers', 'loans.loan_center_id', '=', 'centers.center_id')
            ->join('users', 'centers.center_user_id', '=', 'users.id');


  $columns = [ // Set Column to be displayed
      'Group' => 'customer_group_id',
      'Center' => 'center_name',
      'User' => 'name',
      'CIF'=>'customer_id', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
      'Name' => 'customer_name',

      'Amount' =>'loan_amount',
      'Total' =>'installment_total',
      'Balance' =>'installment_balance',
      'W Interest' =>'installment_add',
      'Areas Capital' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_balance-($result->loan_amount-(($result->installment_count-1)*$result->installment_per_week))) ;

        },
      'Interest < 13' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_count<13)?$result->installment_areas:$result->installment_add*13 ;


        },
      'Interest > 13' => function($result) { // You can do if statement or any action do you want inside this closure
          return ($result->installment_count>13)?$result->installment_areas:0.0;

        },

      'TL' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->installment_count-1) ;
        },



      'Remain' => function($result) { // You can do if statement or any action do you want inside this closure
            return (14-$result->installment_count) ;
        }
  ];



  // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
  $pdf = PdfReport::of($title, $meta, $queryBuilder, $columns)
                //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                  //    'displayAs' => function($result) {
                //          return $result->registered_at->format('d M Y');
                //      },
                //      'class' => 'left'
                //  ])
                 ->editColumns(['Group', 'CIF','Name','Amount','Balance','Total','W Interest','Areas Capital',
                 'Interest > 13','Interest < 13','TL','Remain'], [ // Mass edit column
                     'class' => 'right bold'
                  ])
                //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                  //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                //  ])
                ->groupBy('Center')
                ->showTotal([
                    'Amount' => 'point',
                    'Total' => 'point',
                    'Balance' => 'point',
                    'Areas Capital' => 'point',
                    'Interest > 13' => 'point',
                    'Interest < 13' => 'point'

                ])
                ->setPaper('a4')
                ->setOrientation('landscape')


                 ->limit(10) // Limit record to be showed
                 ->make()
                ; // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

return $pdf ->stream('my.pdf',array('Attachment'=>false));

}


/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function showcollection()
{
  if( Auth::check() ){

    if((Auth::user()->user_role_id<3)){

      $branches=Branch::all();

    }else if((Auth::user()->user_role_id<4)){

      $branches=Branch::where('branch_id',Auth::user()->branch_id)->get();


    }else {

   $branches=Branch::where('branch_id',Auth::user()->branch_id)->get();

    }

       return view('reports.collection', ['branches'=>$branches]);
  }
  return view('auth.login');
}




public function collection(Request $request)
{
  //$fromDate = $request->input('from_date');
  //$toDate = $request->input('to_date');
  //$sortBy = $request->input('sort_by');
  $cid=intval($request->input('cid'));
  $branch = Branch::where('branch_id',$cid)->get()->first();
  $title = 'Collection sheet'; // Report title

  $meta = [ // For displaying filters description on header
      'Collection sheet of' => $branch->branch_name
      //'Sort By' => $sortBy
  ];

  $queryBuilder = Loan::select(['loans.loan_id','loans.loan_center_id','loans.loan_amount', 'loans.loan_customer_id','customers.customer_name',
  'customers.customer_id','installments.installment_last_payment_date','installments.installment_last_payment']) // Do some querying..
                      ->where('loan_branch_id',$cid)
            ->join('installments', 'loans.loan_id', '=', 'installments.installment_loan_id')
            ->join('customers', 'loans.loan_customer_id', '=', 'customers.customer_id');


  $columns = [ // Set Column to be displayed
    'Center' => 'loan_center_id',
      'Loan' => 'loan_id',
      'Customer'=>'customer_name', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
      'Amount' =>'loan_amount',
      'Payment Date' =>'installment_last_payment_date',
      'Payment Amount' =>'installment_last_payment',
  ];



  // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
  $pdf = PdfReport::of($title, $meta, $queryBuilder, $columns)
                //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                  //    'displayAs' => function($result) {
                //          return $result->registered_at->format('d M Y');
                //      },
                //      'class' => 'left'
                //  ])
                 ->editColumns(['Group', 'CIF','Name','Amount','Payment Date','Payment Amount'], [ // Mass edit column
                     'class' => 'right bold'
                  ])
                   ->groupBy('Center')
                   ->showTotal([
                       'Payment Amount' => 'point'
                   ])

                //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                  //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                //  ])
                ->setPaper('a4')
                ->setOrientation('landscape')


                 ->limit(10) // Limit record to be showed
                 ->make()
                ; // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

return $pdf ->stream('my.pdf',array('Attachment'=>false));

}


/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function showpayment()
{
  if( Auth::check() ){

    if((Auth::user()->user_role_id<3)){

      $payments=Payment::all();

    }else if((Auth::user()->user_role_id<4)){

      $payments=Payment::all();


    }else {

   $payments=Payment::all();

    }

       return view('reports.payment', ['payments'=>$payments]);
  }
  return view('auth.login');
}




public function payment(Request $request)
{
  //$fromDate = $request->input('from_date');
  //$toDate = $request->input('to_date');
  //$sortBy = $request->input('sort_by');
  $cid=intval($request->input('cid'));
  $payment = Payment::where('payment_id',$cid)->get()->first();
  $title = 'Payment Report'; // Report title

  $meta = [ // For displaying filters description on header
      'Payment Report of' => $payment->payment_id
      //'Sort By' => $sortBy
  ];

  $queryBuilder = Payment::select(['payments.*', 'loans.*','historyofloans.*','customers.*']) // Do some querying..
                      ->where('payments.payment_id',$cid)
                      ->join('historyofloans', 'payments.payment_id', '=', 'historyofloans.historyofloan_payment_id')
                      ->join('loans', 'historyofloans.historyofloan_loan_id', '=', 'loans.loan_id')
                      ->join('customers', 'loans.loan_customer_id', '=', 'customers.customer_id');
                      //->orderBy($sortBy);

  $columns = [ // Set Column to be displayed
      'Loan Id' => 'loan_id',
      'Amount' =>'loan_amount',
      'CIF'=>'customer_id', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
      'Name' => 'customer_name',

      'Branch' =>'customer_branch_id',
      'Center' =>'customer_center_id',
      'Group' =>'customer_group_id',
      'Date' =>'payment_date',
      'Payment' =>'historyofloan_amount',

  ];



  // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
  $pdf = PdfReport::of($title, $meta, $queryBuilder, $columns)
                //  ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                  //    'displayAs' => function($result) {
                //          return $result->registered_at->format('d M Y');
                //      },
                //      'class' => 'left'
                //  ])
                 ->editColumns(['Loan Id', 'CIF','Name','Amount','Branch','Center','Group','Date','Payment'], [ // Mass edit column
                     'class' => 'right bold'
                  ])
                //  ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                  //    'Total CIF' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                //  ])
                ->setPaper('a4')
                ->setOrientation('landscape')


                 ->limit(10) // Limit record to be showed
                 ->make()
                ; // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

return $pdf ->stream('my.pdf',array('Attachment'=>false));

}




}
