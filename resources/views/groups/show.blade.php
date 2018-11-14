@extends('layouts.dashboard')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left ">
      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <!-- Jumbotron -->
      <div class="well well-lg" >
        <h1>{{ $group->group_id }}</h1>
        <p class="lead">{{ $group->group_center_id }}</p>
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
              <li><a href="#">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              Edit</a></li>
              <li><a href="/groups/create"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create new group</a></li>
              <li><a href="/groups"><i class="fa fa-user-o" aria-hidden="true"></i> My groups</a></li>

            <br/>


            @if(Auth::user()->id<4)

              <li>
              <i class="fa fa-power-off" aria-hidden="true"></i>
              <a
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this project?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('groups.destroy',[$group->group_id]) }}"
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
              </form>

              </li>
 @endif
              <!-- <li><a href="#">Add new member</a></li> -->
            </ol>
<hr/>


<br/>

          </div>

          <!--<div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
            </ol>
          </div> -->
        </div>





@endsection
