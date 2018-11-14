@extends('layouts.dashboard')

@section('content')

<div class="col-sm-10 col-md-10 col-lg-10 col-md-offset-1  col-sm-offset-1 col-lg-offset-1">
    <div class="panel panel-primary filterable">
    <div class="panel-heading">Loans
       <div class="pull-right">
              <button class="btn btn-default btn-sm btn-filter "><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>
            <a  class="pull-right btn btn-default btn-sm" href="/loans/create">
    Create new</a>
   </div>

    <div class="panel-body">


      <table class="table">
                     <thead>
                         <tr class="filters">
                             <th><input type="text" class="form-control" placeholder="Loan Id" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Customer" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Center" disabled></th>


                         </tr>
                     </thead>
                     <tbody>
                       @foreach($loans as $loan)
                         <tr>
                             <td>  <a href="/loans/{{ $loan->loan_id }}" >{{ $loan->loan_id }}</a></li></td>
                            <td>  <a href="/loans/{{ $loan->loan_id }}" >{{ $loan->customer->customer_name_with_initials }}</a></li></td>
                            <td>  <a href="/loans/{{ $loan->loan_id }}" >{{ $loan->loan_amount }}</a></li></td>
                            <td>  <a href="/loans/{{ $loan->loan_id }}" >{{ $loan->center->center_name }}</a></li></td>

                         </tr>
                          @endforeach
                     </tbody>
                 </table>

    </div>
    </div>
</div>

@endsection
