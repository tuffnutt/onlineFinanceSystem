@extends('layouts.dashboard')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left ">
      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <!-- Jumbotron -->
      <div class="well well-lg" >
        <h1>LID : {{ $loan->loan_id }}</h1>
        <p class="lead">Amount : {{ $loan->loan_amount }}</p>
        <p class="lead">Name : {{ $loan->customer->customer_name}}</p>
       <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
      </div>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px; ">
     <!-- <a href="/projects/create" class="pull-right btn btn-default btn-sm" >Add Project</a> -->
<br/>





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
              <li><a href="/loans/{{ $loan->loan_id }}/edit">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              Edit</a></li>
              <li><a href="/loans/create"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create new loan</a></li>
              <li><a href="/loans"><i class="fa fa-user-o" aria-hidden="true"></i> My loans</a></li>

            <br/>


            @if(Auth::user()->id<2)

              <li>
              <i class="fa fa-power-off" aria-hidden="true"></i>
              <a
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this loan?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('loans.destroy',[$loan->loan_id]) }}"
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">

                        {{ csrf_field() }}


                  <div class="form-group">
                      <label for="customer-address">Address<span class="required">*</span></label>
                      <textarea placeholder="Enter Address"
                                style="resize: vertical"
                                required
                                id="customer-address"
                                name="address"
                                rows="5" spellcheck="false"
                                class="form-control autosize-target text-left">

                                </textarea>

                              </div>
              </form>

              </li>
 @endif
              <!-- <li><a href="#">Add new member</a></li> -->
            </ol>


<hr/>
  @if(Auth::user()->id<2)
<h4>Deactivate</h4>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12  col-sm-12 ">
              <form id="add-user" action="{{ route('loans.deactivate') }}"  method="POST" >
                {{ csrf_field() }}
                <div class="input-group">
                  <input class="form-control" name = "loan_id" id="loan_id" value="{{$loan->loan_id}}" type="hidden">

                  <div class="form-group">

                      <textarea placeholder="Enter Address"
                                style="resize: vertical"
                                required
                                id="customer-address"
                                name="discription"
                                rows="5" spellcheck="false"
                                class="form-control autosize-target text-left">

                                </textarea>

                              </div>

                    <button class="btn btn-default" type="submit" id="deactivate" >Deactivate</button>

                </div><!-- /input-group -->
                </form>
              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
<br/>
 @endif

</div>
</div>


@endsection
