@extends('layouts.dashboard')

@section('content')



<div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white;">
<h1>Update center </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('centers.update',[$center->center_id]) }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="put">


                            <div class="form-group">
                                <label for="center-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"
                                          id="center-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $center->center_name }}"

                                           />
                            </div>


                            <div class="form-group">
                                <label for="center-address">Address</label>
                                <textarea placeholder="Enter description"
                                          style="resize: vertical"
                                          id="center-address"
                                          name="address"
                                          rows="3" spellcheck="false"
                                          value="{{ $center->center_address }}"
                                          class="form-control autosize-target text-left">

                                            {{ $center->center_address }}
                                          </textarea>
                            </div>

                            <div class="form-group">
                                <label for="center-day">Collect Day<span class="required">*</span></label>
                                <select class="form-control form-control-lg" name="collectday" id="center-day" onchange="#" required>
                                      <option   value="{{ $center->center_collect_day }}">Choose... </option>


                                         <option value="Monday">Monday</option>
                                         <option value="Tuesday">Tuesday</option>
                                         <option value="Wednesday">Wednesday</option>
                                         <option value="Thursday">Thursday</option>
                                         <option value="Friday">Friday</option>
                                         <option value="Saturday">Saturday</option>
                                         <option value="Sunday">Sunday</option>

                                       </select>

                                  </div>


                                  <div class="form-group">
                                      <label for="user">User<span class="required">*</span></label>
                                      <select class="form-control form-control-lg" name="user" id="user" onchange="#" required>
                                            <option   value="{{ $center->center_user_id }}">Choose... </option>

                                             @foreach ($users as $user)
                                               <option value="{{$user->id}}">{{$user->name}}</option>
                                             @endforeach
                                             </select>

                                        </div>


                                  <div class="form-group">
                                      <label for="branch">Branch<span class="required">*</span></label>
                                      <select class="form-control form-control-lg" name="branch" id="branch" onchange="#" required>
                                            <option   value="{{ $center->center_branch_id }}">Choose... </option>

                                             @foreach ($branches as $branch)
                                               <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
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
              <li><a href="/centers/{{ $center->center_id }}"><i class="fa fa-building-o" aria-hidden="true"></i>
               View center</a></li>
              <li><a href="/centers"><i class="fa fa-building" aria-hidden="true"></i> All centers</a></li>

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
