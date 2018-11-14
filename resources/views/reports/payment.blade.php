@extends('layouts.dashboard')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white; ">
    <h1>Payment Report </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" target="_blank" action="{{ route('reports.payment') }}">
                            {{ csrf_field() }}



                            <div class="form-group">
                                <label for="group-customerid1">Payment<span class="required">*</span></label>
                                <select class="form-control form-control-lg" name="cid" id="group-customerid1" onchange="#" required>
                                      <option value="">Choose... </option>

                                       @foreach ($payments as $payment)
                                         <option value="{{$payment->payment_id}}">{{$payment->payment_id}}</option>
                                       @endforeach
                                       </select>

                                  </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>


      </div>
</div>


<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
          <!--<div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>


          <!--<div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
            </ol>
          </div> -->
        </div>


    @endsection
