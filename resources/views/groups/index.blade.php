@extends('layouts.dashboard')

@section('content')

<div class="col-sm-10 col-md-10 col-lg-10 col-md-offset-1  col-sm-offset-1 col-lg-offset-1">
    <div class="panel panel-primary filterable">
    <div class="panel-heading">Groups
       <div class="pull-right">
              <button class="btn btn-default btn-sm btn-filter "><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>
            <a  class="pull-right btn btn-default btn-sm" href="/groups/create">
    Create new</a>
   </div>

    <div class="panel-body">


      <table class="table">
                     <thead>
                         <tr class="filters">
                             <th><input type="text" class="form-control" placeholder="Group No" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Center" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Customer" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Customer" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Customer" disabled></th>

                         </tr>
                     </thead>
                     <tbody>
                       @foreach($groups as $group)
                         <tr>
                             <td>  <a href="/groups/{{ $group->group_id }}" >{{ $group->group_id }}</a></li></td>
                             <td>  <a href="/groups/{{ $group->group_id }}" >{{ $group->group_center_id}}</a></li></td>
                             <td>  <a href="/groups/{{ $group->group_id }}" >{{ $group->group_customer_id1 }}</a></li></td>
                             <td>  <a href="/groups/{{ $group->group_id }}" >{{ $group->group_customer_id2 }}</a></li></td>
                             <td>  <a href="/groups/{{ $group->group_id }}" >{{ $group->group_customer_id3 }}</a></li></td>

                         </tr>
                          @endforeach
                     </tbody>
                 </table>

    </div>
    </div>
</div>

@endsection
