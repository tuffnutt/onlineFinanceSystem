@extends('layouts.dashboard')

@section('content')



<div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white;">
<h1>Update Group </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('groups.update',[$group->_group_id]) }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group">
                                <label for="group-centerid">Group<span class="required">*</span></label>
                                <select class="form-control form-control-lg" name="centerid" id="group-center_user_id" onchange="#" required>
                                      <option value="{{$group->group_center_id}}">Choose... </option>

                                       @foreach ($centers as $center)
                                         <option value="{{$center->center_id}}">{{$center->center_name}}</option>
                                       @endforeach
                                       </select>

                                  </div>

                                  <div class="form-group">
                                      <label for="group-customerid1">Customer<span class="required">*</span></label>
                                      <select class="form-control form-control-lg" name="cust1" id="group-customerid1" onchange="#" required>
                                            <option value="{{$group->group_customer_id1}}">Choose... </option>

                                             @foreach ($customers as $customer)
                                               <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                             @endforeach
                                             </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="group-customerid2">Customer<span class="required">*</span></label>
                                            <select class="form-control form-control-lg" name="cust2" id="group-customerid2" onchange="#" required>
                                                  <option value="{{$group->group_customer_id2}}">Choose... </option>

                                                   @foreach ($customers as $customer)
                                                     <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                                   @endforeach
                                                   </select>

                                              </div>

                                              <div class="form-group">
                                                  <label for="group-customerid3">Customer<span class="required">*</span></label>
                                                  <select class="form-control form-control-lg" name="cust3" id="group-customerid3" onchange="#" required>
                                                        <option value="{{$group->group_customer_id3}}">Choose... </option>

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
              <li><a href="/groups/{{ $group->group_id }}"><i class="fa fa-building-o" aria-hidden="true"></i> View group</a></li>
              <li><a href="/groups"><i class="fa fa-building" aria-hidden="true"></i> All groups</a></li>

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
