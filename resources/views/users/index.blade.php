@extends('layouts.dashboard')

@section('content')

<div class="col-sm-10 col-md-10 col-lg-10 col-md-offset-1  col-sm-offset-1 col-lg-offset-1">
    <div class="panel panel-primary filterable ">
    <div class="panel-heading">Users
      <div class="pull-right">
             <button class="btn btn-default btn-sm btn-filter "><span class="glyphicon glyphicon-filter"></span> Filter</button>
       </div>
        <a  class="pull-right btn btn-default btn-sm" href="/register">
      Create new</a> </div>
    <div class="panel-body">


      <table class="table">
                     <thead>
                         <tr class="filters">
                             <th><input type="text" class="form-control" placeholder="UIF No" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Branch" disabled></th>

                         </tr>
                     </thead>
                     <tbody>
                       @foreach($users as $user)
                         <tr>
                             <td>    <a href="/users/{{ $user->id }}" >  {{ $user->id }}</a></td>
                             <td>  <a href="/users/{{ $user->id }}" >  {{ $user->name }}</a></td>
                             <td>  <a href="/users/{{ $user->id }}" >  {{ $user->user_branch_id }}</a></td>

                         </tr>
                          @endforeach
                     </tbody>
                 </table>







    </div>
    </div>
</div>

@endsection
