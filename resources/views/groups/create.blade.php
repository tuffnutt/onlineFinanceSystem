@extends('layouts.dashboard')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white; ">
    <h1>Create new group </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('groups.store') }}">
                            {{ csrf_field() }}





                                <div class="form-group">
                                    <label for="group-centerid">Center<span class="required">*</span></label>
                                    <select class="form-control form-control-lg" name="centerid" id="group-center_user_id" onchange="#" required>
                                          <option value="">Choose... </option>

                                           @foreach ($centers as $center)
                                             <option value="{{$center->center_id}}">{{$center->center_name}}</option>
                                           @endforeach
                                           </select>

                                      </div>

                                      <div class="form-group">
                                          <label for="group-customerid1">Customer<span class="required">*</span></label>
                                          <select class="form-control form-control-lg" name="cust1" id="group-customerid1" onchange="#" required>
                                                <option value="">Choose... </option>

                                                 @foreach ($customers as $customer)
                                                   <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                                 @endforeach
                                                 </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="group-customerid2">Customer<span class="required">*</span></label>
                                                <select class="form-control form-control-lg" name="cust2" id="group-customerid2" onchange="#" required>
                                                      <option value="">Choose... </option>

                                                       @foreach ($customers as $customer)
                                                         <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                                       @endforeach
                                                       </select>

                                                  </div>

                                                  <div class="form-group">
                                                      <label for="group-customerid3">Customer<span class="required">*</span></label>
                                                      <select class="form-control form-control-lg" name="cust3" id="group-customerid3" onchange="#" required>
                                                            <option value="">Choose... </option>

                                                             @foreach ($customers as $customer)
                                                               <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
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
          </div> -->
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/groups"><i class="fa fa-user-o" aria-hidden="true"></i> My groups</a></li>

            </ol>
          </div>

          <!--<div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
            </ol>
          </div> -->
        </div>


    @endsection
