<?php

namespace App\Http\Controllers;

use App\Installment;
use Illuminate\Support\Facades\Auth;
use App\Loan;
use Illuminate\Http\Request;

class InstallmentsController extends Controller
{


  public function init(Loan $loan)
  {
    if(Auth::check()){
        $installment = Installment::create([
          'installment_loan_id' => $loan->loan_id,
          'installment_balance' => $loan->loan_amount,
          'installment_count' => 1,
          'installment_add' => ($loan->loan_amount)*0.095999/4,
          'installment_per_week' => ($loan->loan_amount)/13,
          'installment_total' => 0.0,
          'installment_areas' => 0.0


        ]);

    }

        return back()->withInput()->with('errors', 'Error creating new installment');
  }



  public function insert($loanid,$amount,$pid)
  {
    $date=date("Y/m/d");
    $ins = Installment::where('installment_loan_id',$loanid)->get()->first();

	$count =$ins->installment_count;
  $bal=$ins->installment_balance;
  $add=$ins->installment_add;
  $total=$ins->installment_total;
  $areas=$ins->installment_areas;

	if($count==1){
		$cur=$amount;
    $bal=$bal-$cur;
    $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                           ->update([
                             'd1' =>$date,
                             'a1' =>$cur,
                             'installment_count'=>$count+1,
                             'installment_total'=>$total+$cur,
                             'installment_balance'=>$bal,
                             'installment_last_payment'=>$amount,
                             'installment_last_payment_date'=>$date
                        ]);
                 }
                 else{

                    if($amount>($add+$areas)){
                      $cur=$amount-($add+$areas);
                        $bal=$bal-$cur;
                        switch ($count) {
                            case 1:
                            $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                   ->update([
                                                     'd1' =>$date,
                                                     'a1' =>$cur,
                                                     'installment_count'=>$count+1,
                                                     'installment_total'=>$total+$amount,
                                                     'installment_balance'=>$bal,
                                                     'installment_last_payment'=>$amount,
                                                     'installment_last_payment_date'=>$date
                                                ]);
                              break;
                              case 2:
                              $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                     ->update([
                                                       'd2' =>$date,
                                                       'a2' =>$cur,
                                                       'installment_count'=>$count+1,
                                                       'installment_total'=>$total+$amount,
                                                       'installment_balance'=>$bal,
                                                       'installment_last_payment'=>$amount,
                                                       'installment_last_payment_date'=>$date
                                                  ]);
                                break;
                                case 3:
                                $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                       ->update([
                                                         'd3' =>$date,
                                                         'a3' =>$cur,
                                                         'installment_count'=>$count+1,
                                                         'installment_total'=>$total+$amount,
                                                         'installment_balance'=>$bal,
                                                         'installment_last_payment'=>$amount,
                                                         'installment_last_payment_date'=>$date
                                                    ]);
                                  break;
                                  case 4:
                                  $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                         ->update([
                                                           'd4' =>$date,
                                                           'a4' =>$cur,
                                                           'installment_count'=>$count+1,
                                                           'installment_total'=>$total+$amount,
                                                           'installment_balance'=>$bal,
                                                           'installment_last_payment'=>$amount,
                                                           'installment_last_payment_date'=>$date
                                                      ]);
                                    break;
                                    case 5:
                                    $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                           ->update([
                                                             'd5' =>$date,
                                                             'a5' =>$cur,
                                                             'installment_count'=>$count+1,
                                                             'installment_total'=>$total+$amount,
                                                             'installment_balance'=>$bal,
                                                             'installment_last_payment'=>$amount,
                                                             'installment_last_payment_date'=>$date
                                                        ]);
                                      break;
                                      case 6:
                                      $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                             ->update([
                                                               'd6' =>$date,
                                                               'a6' =>$cur,
                                                               'installment_count'=>$count+1,
                                                               'installment_total'=>$total+$amount,
                                                               'installment_balance'=>$bal,
                                                               'installment_last_payment'=>$amount,
                                                               'installment_last_payment_date'=>$date
                                                          ]);
                                        break;
                                        case 7:
                                        $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                               ->update([
                                                                 'd7' =>$date,
                                                                 'a7' =>$cur,
                                                                 'installment_count'=>$count+1,
                                                                 'installment_total'=>$total+$amount,
                                                                 'installment_balance'=>$bal,
                                                                 'installment_last_payment'=>$amount,
                                                                 'installment_last_payment_date'=>$date
                                                            ]);
                                          break;

                                          case 8:
                                          $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                 ->update([
                                                                   'd8' =>$date,
                                                                   'a8' =>$cur,
                                                                   'installment_count'=>$count+1,
                                                                   'installment_total'=>$total+$amount,
                                                                   'installment_balance'=>$bal,
                                                                   'installment_last_payment'=>$amount,
                                                                   'installment_last_payment_date'=>$date
                                                              ]);
                                            break;

                                            case 9:
                                            $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                   ->update([
                                                                     'd9' =>$date,
                                                                     'a9' =>$cur,
                                                                     'installment_count'=>$count+1,
                                                                     'installment_total'=>$total+$amount,
                                                                     'installment_balance'=>$bal,
                                                                     'installment_last_payment'=>$amount,
                                                                     'installment_last_payment_date'=>$date
                                                                ]);
                                              break;

                                              case 10:
                                              $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                     ->update([
                                                                       'd10' =>$date,
                                                                       'a10' =>$cur,
                                                                       'installment_count'=>$count+1,
                                                                       'installment_total'=>$total+$amount,
                                                                       'installment_balance'=>$bal,
                                                                       'installment_last_payment'=>$amount,
                                                                       'installment_last_payment_date'=>$date
                                                                  ]);
                                                break;

                                                case 11:
                                                $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                       ->update([
                                                                         'd11' =>$date,
                                                                         'a11' =>$cur,
                                                                         'installment_count'=>$count+1,
                                                                         'installment_total'=>$total+$amount,
                                                                         'installment_balance'=>$bal,
                                                                         'installment_last_payment'=>$amount,
                                                                         'installment_last_payment_date'=>$date
                                                                    ]);
                                                  break;

                                                  case 12:
                                                  $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                         ->update([
                                                                           'd12' =>$date,
                                                                           'a12' =>$cur,
                                                                           'installment_count'=>$count+1,
                                                                           'installment_total'=>$total+$amount,
                                                                           'installment_balance'=>$bal,
                                                                           'installment_last_payment'=>$amount,
                                                                           'installment_last_payment_date'=>$date
                                                                      ]);
                                                    break;

                                                    case 13:
                                                    $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                           ->update([
                                                                             'd13' =>$date,
                                                                             'a13' =>$cur,
                                                                             'installment_count'=>$count+1,
                                                                             'installment_total'=>$total+$amount,
                                                                             'installment_balance'=>$bal,
                                                                             'installment_last_payment'=>$amount,
                                                                             'installment_last_payment_date'=>$date
                                                                        ]);
                                                      break;

                                                      default:
		                                                  break;

	                                                   }

                 }else if($amount>=0){
                   $cur=0;

    	              switch ($count) {
                      case 1:
                      $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                             ->update([
                                               'd1' =>$date,
                                               'a1' =>0.0,
                                               'installment_count'=>$count+1,
                                               'installment_total'=>$total+$amount,
                                               'installment_areas'=>$areas+($add-$amount),
                                               'installment_balance'=>$bal-$cur,
                                               'installment_last_payment'=>$amount,
                                               'installment_last_payment_date'=>$date
                                          ]);
                        break;
                        case 2:
                        $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                               ->update([
                                                 'd2' =>$date,
                                                 'a2' =>0.0,
                                                 'installment_count'=>$count+1,
                                                 'installment_total'=>$total+$amount,
                                                 'installment_areas'=>$areas+($add-$amount),
                                                 'installment_balance'=>$bal-$cur,
                                                 'installment_last_payment'=>$amount,
                                                 'installment_last_payment_date'=>$date
                                            ]);
                          break;
                          case 3:
                          $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                 ->update([
                                                   'd3' =>$date,
                                                   'a3' =>0.0,
                                                   'installment_count'=>$count+1,
                                                   'installment_total'=>$total+$amount,
                                                   'installment_areas'=>$areas+($add-$amount),
                                                   'installment_balance'=>$bal-$cur,
                                                   'installment_last_payment'=>$amount,
                                                   'installment_last_payment_date'=>$date
                                              ]);
                            break;
                            case 4:
                            $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                   ->update([
                                                     'd4' =>$date,
                                                     'a4' =>0.0,
                                                     'installment_count'=>$count+1,
                                                     'installment_total'=>$total+$amount,
                                                     'installment_areas'=>$areas+($add-$amount),
                                                     'installment_balance'=>$bal-$cur,
                                                     'installment_last_payment'=>$amount,
                                                     'installment_last_payment_date'=>$date
                                                ]);
                              break;
                              case 5:
                              $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                     ->update([
                                                       'd5' =>$date,
                                                       'a5' =>0.0,
                                                       'installment_count'=>$count+1,
                                                       'installment_total'=>$total+$amount,
                                                       'installment_areas'=>$areas+($add-$amount),
                                                       'installment_balance'=>$bal-$cur,
                                                       'installment_last_payment'=>$amount,
                                                       'installment_last_payment_date'=>$date
                                                  ]);
                                break;
                                case 6:
                                $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                       ->update([
                                                         'd6' =>$date,
                                                         'a6' =>0.0,
                                                         'installment_count'=>$count+1,
                                                         'installment_total'=>$total+$amount,
                                                         'installment_areas'=>$areas+($add-$amount),
                                                         'installment_balance'=>$bal-$cur,
                                                         'installment_last_payment'=>$amount,
                                                         'installment_last_payment_date'=>$date
                                                    ]);
                                  break;
                                  case 7:
                                  $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                         ->update([
                                                           'd7' =>$date,
                                                           'a7' =>0.0,
                                                           'installment_count'=>$count+1,
                                                           'installment_total'=>$total+$amount,
                                                           'installment_areas'=>$areas+($add-$amount),
                                                           'installment_balance'=>$bal-$cur,
                                                           'installment_last_payment'=>$amount,
                                                           'installment_last_payment_date'=>$date
                                                      ]);
                                    break;

                                    case 8:
                                    $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                           ->update([
                                                             'd8' =>$date,
                                                             'a8' =>0.0,
                                                             'installment_count'=>$count+1,
                                                             'installment_total'=>$total+$amount,
                                                             'installment_areas'=>$areas+($add-$amount),
                                                             'installment_balance'=>$bal-$cur,
                                                             'installment_last_payment'=>$amount,
                                                             'installment_last_payment_date'=>$date
                                                        ]);
                                      break;

                                      case 9:
                                      $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                             ->update([
                                                               'd9' =>$date,
                                                               'a9' =>0.0,
                                                               'installment_count'=>$count+1,
                                                               'installment_total'=>$total+$amount,
                                                               'installment_areas'=>$areas+($add-$amount),
                                                               'installment_balance'=>$bal-$cur,
                                                               'installment_last_payment'=>$amount,
                                                               'installment_last_payment_date'=>$date
                                                          ]);
                                        break;

                                        case 10:
                                        $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                               ->update([
                                                                 'd10' =>$date,
                                                                 'a10' =>0.0,
                                                                 'installment_count'=>$count+1,
                                                                 'installment_total'=>$total+$amount,
                                                                 'installment_areas'=>$areas+($add-$amount),
                                                                 'installment_balance'=>$bal-$cur,
                                                                 'installment_last_payment'=>$amount,
                                                                 'installment_last_payment_date'=>$date
                                                            ]);
                                          break;

                                          case 11:
                                          $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                 ->update([
                                                                   'd11' =>$date,
                                                                   'a11' =>0.0,
                                                                   'installment_count'=>$count+1,
                                                                   'installment_total'=>$total+$amount,
                                                                   'installment_areas'=>$areas+($add-$amount),
                                                                   'installment_balance'=>$bal-$cur,
                                                                   'installment_last_payment'=>$amount,
                                                                   'installment_last_payment_date'=>$date
                                                              ]);
                                            break;

                                            case 12:
                                            $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                   ->update([
                                                                     'd12' =>$date,
                                                                     'a12' =>0.0,
                                                                     'installment_count'=>$count+1,
                                                                     'installment_total'=>$total+$amount,
                                                                     'installment_areas'=>$areas+($add-$amount),
                                                                     'installment_balance'=>$bal-$cur,
                                                                     'installment_last_payment'=>$amount,
                                                                     'installment_last_payment_date'=>$date
                                                                ]);
                                              break;

                                              case 13:
                                              $installmentUpdate = Installment::where('installment_loan_id', $loanid)
                                                                     ->update([
                                                                       'd13' =>$date,
                                                                       'a13' =>0.0,
                                                                       'installment_count'=>$count+1,
                                                                       'installment_total'=>$total+$amount,
                                                                       'installment_areas'=>$areas+($add-$amount),
                                                                       'installment_balance'=>$bal-$cur,
                                                                       'installment_last_payment'=>$amount,
                                                                       'installment_last_payment_date'=>$date
                                                                  ]);
                                                break;

                                                default:
                                                break;

                                               }
                                }else{
                                  //
                                }

                        }

                        if($bal<=0){
                          //finish loan
                            app('App\Http\Controllers\LoansController')->finished(Loan::find($loanid));
                        }

            }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function show(Installment $installment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function edit(Installment $installment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Installment $installment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Installment $installment)
    {
        //
    }
}
