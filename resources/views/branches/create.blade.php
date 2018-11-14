@extends('layouts.dashboard')

@section('content')




     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white;">
    <h1>Create new Branch </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('branches.store') }}">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <label for="branch-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"
                                          id="branch-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                           />
                            </div>


                            <div class="form-group">
                                <label for="brsnch-content">Address<span class="required">*</span></label>
                                <textarea placeholder="Enter Address"
                                          style="resize: vertical"
                                          id="branch-content"
                                          required
                                          name="address"
                                          rows="4" spellcheck="false"
                                          class="form-control autosize-target text-left">


                                          </textarea>
                            </div>

                            <div class="form-group">
                                <label for="branch-telephone">Telephone<span class="required">*</span></label>
                                <input   placeholder="Enter telephone no"
                                          id="branch-telephone"
                                          required
                                          name="telephone"
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
              <li><a href="/branches"> <i class="fa fa-building-o" aria-hidden="true"></i> My Branches</a></li>

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
