<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if( Auth::check() ){

        if((Auth::user()->user_role_id<3)){
          $transactions = Transaction::all();

        }else if((Auth::user()->user_role_id<4)){

          $transactions = Transaction::where('transaction_center_id',Auth::user()->user_center_id)->get();

        }else{

            $transactions = Transaction::where('transaction_user_id',Auth::user()->id)->get();

        }
           return view('transactions.index', ['transactions'=> $transactions]);
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
        return view('transactions.create');
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
          $transaction = Transaction::create([
              'transaction_amount' => $request->input('amount'),
              'transaction_user_id' => Auth::user()->id,
              'transaction_center_id' => Auth::user()->user_center_id,
              'transaction_date' => date("Y/m/d"),
              'transaction_lend' => $request->input('type')

          ]);


          if($transaction){
              return redirect()->route('transaction.index', ['transactions'=> $transaction])
              ->with('success' , 'Branch created successfully');
          }

      }

          return back()->withInput()->with('errors', 'Error creating new branch');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
