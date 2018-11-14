@extends('layouts.dashboard')

@section('content')

<div class="col-md-10 col-sm-10 col-lg-10 col-md-offset-1 col-sm-offset-1  col-lg-offset-1">
    <div class="panel panel-primary ">
    <div class="panel-heading">Centers<a  class="pull-right btn btn-default btn-sm" href="/centers/create">
    Create new</a> </div>
    <div class="panel-body">


    <ul class="list-group">
    @foreach($centers as $center)
        <li class="list-group-item">
        <i class="fa fa-play" aria-hidden="true"></i> <a href="/centers/{{ $center->center_id }}" >  {{ $center->center_name }}</a></li>
    @endforeach
    </ul>


    </div>
    </div>
</div>

@endsection
