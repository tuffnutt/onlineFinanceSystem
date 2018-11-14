@extends('layouts.dashboard')

@section('content')

<div class="col-sm-12 col-md-12 col-lg-12 col-md-offset-0  col-sm-offset-0 col-lg-offset-0">
<div class="col-sm-12 col-md-12 col-lg-12">
  <form method="post" action="{{ route('customers.loadcenterinsupdate') }}">
                        {{ csrf_field() }}


  <div class="col-sm-10 col-md-10 col-lg-10">
                        <div class="form-group">

                            <select class="form-control form-control-lg" name="center" id="center" onchange="#" required>
                                  <option value="">Choose... </option>

                                   @foreach ($centers as $center)
                                     <option value="{{$center->center_id}}">{{$center->center_name}}</option>
                                   @endforeach
                                   </select>

                              </div>
                                </div>

<div class="col-sm-2 col-md-2 col-lg-2">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary"
                                   value="Get Data"/>
                        </div>
                        </div>
                    </form>


  </div><br><br>


    <div class="panel panel-primary filterable">
    <div class="panel-heading">Insuarance Update
       <div class="pull-right">
              <button class="btn btn-default btn-sm btn-filter "><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>
            <a  class="pull-right btn btn-default btn-sm" href="/loans/create">
    Create new</a>
   </div>

    <div class="panel-body">

      <form method="post" action="{{ route('customers.insuarancerepayment') }}">
                            {{ csrf_field() }}
      <table class="table">
                     <thead>
                         <tr class="filters">
                           <th><input type="text" class="form-control" placeholder="CIF No" disabled></th>
                           <th><input type="text" class="form-control" placeholder="NIC" disabled></th>
                           <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                           <th><input type="text" class="form-control" placeholder="Balance" disabled></th>

                           <th><input type="text" class="form-control" placeholder="Amount" disabled></th>


                         </tr>
                     </thead>
                     <tbody>
                         <?php  {{$count=1;}}?>
                       @foreach($customers as $customer)

                         <tr>
                           <td>  <a href="/customers/{{ $customer->customer_id }}" >{{ $customer->customer_id }}</a></td>
                           <td>  <a href="/customers/{{ $customer->customer_id }}" >{{ $customer->customer_nic}}</a></td>

                            <td>  <a href="/customers/{{ $customer->customer_id}} " >{{ $customer->customer_name_with_initials}}</li></td>
                            <td>  <a href="/customers/{{ $customer->customer_id }}" >{{ $customer->customer_insuarance}}</a></td>

                            <td> <input required class="form-control" id="payment" name="{{"a".($customer->customer_id)}}"  type="number" step="0.01" min="0" value="0.00" aria-describedby="amountHelp" placeholder=" "></td>
                            <input required class="form-control" id="count" name="{{$count}}"  type="hidden" value="{{$customer->customer_id}}">
                         </tr>
                      <?php {{ $count=$count+1;}}?>
                          @endforeach
                     </tbody>
                 </table>

                 <input required class="form-control" id="count" name="count"  type="hidden" value={{ $count-1}}>

                  <div class="pull-right">
                 <input type="submit" class="btn btn-primary"
                        value="Update"/>
                      </div>
</form>
    </div>
    </div>
</div>

@endsection
