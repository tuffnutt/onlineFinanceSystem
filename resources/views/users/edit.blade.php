@extends('layouts.dashboard')

@section('content')



<div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white;">
<h1>Update user </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('users.update',[$user->id]) }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group">
                                <label for="user-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"
                                          id="user-name"
                                          @if(Auth::user()->user_role_id>2)
                                          disabled
                                          @endif

                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->name }}"
                                           />
                            </div>
                            <div class="form-group">
                                <label for="user-email">email<span class="required">*</span></label>
                                <input   placeholder="Enter name"
                                          id="user-email"
                                          required
                                          @if(Auth::user()->user_role_id>2)
                                          disabled
                                          @endif
                                          name="email"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->email }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-password">Password<span class="required">*</span></label>
                                <input   placeholder="Enter name"
                                          id="user-password"
                                          required
                                          @if(Auth::user()->id!=$user->id)
                                          disabled
                                          @endif
                                          name="password"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->password }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-firstname">First Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"
                                          id="user-firstname"

                                          name="firstname"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->user_first_name }}"
                                           />
                            </div>


                            <div class="form-group">
                                <label for="user-address">Address</label>
                                <textarea placeholder="Enter Address"
                                          style="resize: vertical"
                                          id="user-address"
                                          name="address"

                                          rows="3" spellcheck="false"
                                          class="form-control autosize-target text-left">
                                          {{ $user->user_address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="user-nic">NIC<span class="required">*</span></label>
                                <input   placeholder="Enter NIC no"
                                          id="user-nic"

                                          name="nic"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->user_nic }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-mobile">Mobile<span class="required">*</span></label>
                                <input   placeholder="Enter mobile no"
                                          id="user-mobile"

                                          name="nic"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->user_mobile }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-landline">Land Line<span class="required">*</span></label>
                                <input   placeholder="Enter land line no"
                                          id="user-landline"

                                          name="landline"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->user_landline }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-birthday">Birthday<span class="required">*</span></label>
                                <input   placeholder="Enter Birthday"
                                          id="user-birthday"

                                          name="birthday"
                                          spellcheck="false"
                                          type="date"
                                          class="form-control"
                                          value="{{ $user->user_birthday }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-marital">Marital Status<span class="required">*</span></label>
                                <input   placeholder="Enter Status"
                                          id="user-marital"

                                          name="marital"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->user_marital_status }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-role">Role<span class="required">*</span></label>
                                <input   placeholder="Enter role"
                                          id="user-role"
                                          required
                                          @if(Auth::user()->user_role_id>1)
                                          disabled
                                          @endif
                                          name="role"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->user_role_id }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-branch">Branch<span class="required">*</span></label>
                                <input   placeholder="Enter branch no"
                                          id="user-branch"

                                          @if(Auth::user()->user_role_id>2)
                                          disabled
                                          @endif
                                          name="branch"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->user_branch_id }}"
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
              <li><a href="/users/{{ $user->id }}"><i class="fa fa-building-o" aria-hidden="true"></i>
               View user</a></li>
              <li><a href="/users"><i class="fa fa-building" aria-hidden="true"></i> All users</a></li>

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
