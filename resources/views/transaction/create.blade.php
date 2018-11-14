@extends('layouts.dashboard')

@section('content')




     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white;">
    <h1>Create new Transaction </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('transaction.store') }}">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <label for="amount">Amount<span class="required">*</span></label>
                                <input   placeholder="Enter amount"
                                          id="amount"
                                          type="number" step="0.01" min="0"
                                          required
                                          name="amount"
                                          spellcheck="false"
                                          class="form-control"
                                           />
                            </div>







                                                              <div class="form-group">
                                                                  <label for="type">Type<span class="required">*</span></label>
                                                                  <select class="form-control form-control-lg" name="type" id="type" onchange="#" required>
                                                                        <option value="">Choose... </option>


                                                                           <option value=true>Lending</option>
                                                                           <option value=false>Receiving</option>

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
              <li><a href="/transactions"> <i class="fa fa-building-o" aria-hidden="true"></i> My transactions</a></li>

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
