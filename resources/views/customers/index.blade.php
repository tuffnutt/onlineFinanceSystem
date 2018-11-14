@extends('layouts.dashboard')

@section('content')

<div class="col-sm-10 col-md-10 col-lg-10 col-md-offset-1  col-sm-offset-1 col-lg-offset-1">
    <div class="panel panel-primary filterable">
    <div class="panel-heading">Customers
       <div class="pull-right">
              <button class="btn btn-default btn-sm btn-filter "><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>
            <a  class="pull-right btn btn-default btn-sm" href="/customers/create">
    Create new</a>
   </div>

    <div class="panel-body">


      <table class="table">
                     <thead>
                         <tr class="filters">
                             <th><input type="text" class="form-control" placeholder="CIF No" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                             <th><input type="text" class="form-control" placeholder="NIC" disabled></th>

                         </tr>
                     </thead>
                     <tbody>
                       @foreach($customers as $customer)
                         <tr>
                             <td>  <a href="/customers/{{ $customer->customer_id }}" >{{ $customer->customer_id }}</a></li></td>
                             <td>  <a href="/customers/{{ $customer->customer_id }}" >{{ $customer->customer_name }}</a></li></td>
                             <td>  <a href="/customers/{{ $customer->customer_id }}" >{{ $customer->customer_nic }}</a></li></td>

                         </tr>
                          @endforeach
                     </tbody>
                 </table>

    </div>
    </div>
</div>

@endsection
