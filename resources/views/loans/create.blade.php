@extends('layouts.dashboard')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white; ">
    <h1>Create new Loan </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('loans.store') }}">
                            {{ csrf_field() }}



                            <div class="form-group">
                                <label for="group-customerid1">Customer<span class="required">*</span></label>
                                <select class="form-control form-control-lg" name="customer" id="group-customerid1" onchange="#" required>
                                      <option value="">Choose... </option>

                                       @foreach ($customers as $customer)
                                         <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                       @endforeach
                                       </select>

                                  </div>
                                  <div class="form-group">
                                      <label for="loan-amount">Amount<span class="required">*</span></label>
                                      <input   placeholder="Enter Amount"
                                                id="loan-amount"
                                                required
                                                type="number" step="0.01" min="0"
                                                name="amount"
                                                spellcheck="false"
                                                class="form-control"
                                                 />
                                  </div>
                                  <div class="form-group">
                                      <label for="loan-date">Date<span class="required">*</span></label>
                                      <input   placeholder="Enter Date"
                                                id="loan-date"
                                                required
                                                name="startdate"
                                                type="date"
                                                spellcheck="false"
                                                class="form-control"
                                                 />
                                  </div>

                                  <div class="form-group">
                                      <label for="loan-documentcharge">Docment Charges<span class="required">*</span></label>
                                      <input   placeholder="Enter document charge"
                                                id="loan-documentcharge"
                                                required
                                                name="documentcharge"
                                                type="hidden"
                                                spellcheck="false"
                                                class="form-control"
                                                 />
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
              <li><a href="/loans"><i class="fa fa-user-o" aria-hidden="true"></i> My Loans</a></li>

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
