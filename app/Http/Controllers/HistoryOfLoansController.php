<?php

namespace App\Http\Controllers;

use App\HistoryOfLoan;
use App\Loan;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryOfLoansController extends Controller
{

  public function insert(Loan $loan,Payment $payment,$amount)
  {
    if(Auth::check()){
        $historyofloan = HistoryOfLoan::create([
          'historyofloan_amount' => $amount,
          'historyofloan_payment_id' => $payment->payment_id,
          'historyofloan_loan_id' => $loan->loan_id

        ]);

    }

        return back()->withInput()->with('errors', 'Error creating new history');
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
     * @param  \App\HistoryOfLoan  $historyOfLoan
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryOfLoan $historyOfLoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoryOfLoan  $historyOfLoan
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryOfLoan $historyOfLoan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoryOfLoan  $historyOfLoan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryOfLoan $historyOfLoan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoryOfLoan  $historyOfLoan
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryOfLoan $historyOfLoan)
    {
        //
    }
}
