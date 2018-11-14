@extends('layouts.dashboard')

@section('content')



     <div class="row col-md-9 col-lg-9 col-sm-9 pull-left " style="background: white; ">
    <h1>Create new customer</h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('customers.store') }}">
                            {{ csrf_field() }}




                            <div class="form-group">
                                <label for="customer-nic">NIC<span class="required">*</span></label>
                                <input   placeholder="Enter nic"
                                          id="customer-nic"
                                          required
                                          name="nic"
                                          spellcheck="false"
                                          class="form-control"
                                           />
                                  </div>
                                  <p id="error" style="color: red;"></p>

                                    @if(Auth::user()->id<3)
                                  <div class="form-group">
                                      <label for="customer-branchid">Branch<span class="required">*</span></label>
                                      <select class="form-control form-control-lg" name="branchid" id="customer-branchid" onchange="#" required>
                                            <option value="">Choose... </option>

                                             @foreach ($branches as $branch)
                                               <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                                             @endforeach
                                             </select>

                                        </div>
                                      @else
                                        <input   hidden
                                                  id="customer-name"
                                                  required
                                                  name="branchid"
                                                  value={{Auth::user()->user_branch_id}}
                                                   />
                                      
                                      @endif

                                  <div class="form-group">
                                      <label for="customer-centerid">Center<span class="required">*</span></label>
                                      <select class="form-control form-control-lg" name="centerid" id="customer-centerid" onchange="#" required>
                                            <option value="">Choose... </option>

                                             @foreach ($centers as $center)
                                               <option value="{{$center->center_id}}">{{$center->center_name}}</option>
                                             @endforeach
                                             </select>

                                        </div>

                                  <div class="form-group">
                                <label for="customer-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"
                                          id="customer-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                           />
                                  </div>
                                  <div class="form-group">
                                      <label for="customer-nameinit">Name With Initials<span class="required">*</span></label>
                                      <input   placeholder="Enter name with initials"
                                                id="customer-nameinit"
                                                required
                                                name="namewithinitials"
                                                spellcheck="false"
                                                class="form-control"
                                                 />
                                        </div>

                                        <div class="form-group">
                                            <label for="customer-birthday">Birthday<span class="required">*</span></label>
                                            <input   placeholder="mm/dd/yy"
                                                      id="customer-birthday"
                                                      required
                                                      type="date"
                                                      name="birthday"
                                                      spellcheck="false"
                                                      class="form-control"
                                                       />
                                              </div>

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

                                              <div class="form-group">
                                                  <label for="customer-occupancy">Occupancy<span class="required">*</span></label>
                                                  <input   placeholder="Enter occupancy"
                                                            id="customer-occupancy"
                                                            required
                                                            name="occupancy"
                                                            spellcheck="false"
                                                            class="form-control"
                                                             />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="customer-mobile">Mobile<span class="required">*</span></label>
                                                        <input   placeholder="Enter mobile"
                                                                  id="customer-mobile"
                                                                  required
                                                                  type="telephone"
                                                                  name="mobile"
                                                                  spellcheck="false"
                                                                  class="form-control"
                                                                   />
                                                          </div>

                                                        <div class="form-group">
                                                              <label for="customer-">Land Line<span class="required"></span></label>
                                                              <input   placeholder="Enter landline"
                                                                        id="customer-landline"

                                                                        type="telephone"
                                                                        name="landline"
                                                                        spellcheck="false"
                                                                        class="form-control"
                                                                         />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="customer-businessphone">Business Phone<span class="required"></span></label>
                                                                    <input   placeholder="Enter Business Phone"
                                                                              id="customer-businessphone"

                                                                              type="telephone"
                                                                              name="businessphone"
                                                                              spellcheck="false"
                                                                              class="form-control"
                                                                               />
                                                                      </div>

                        <div class="form-group">
                            <label for="customer-marital">Marital Status<span class="required">*</span></label>
                            <select class="form-control form-control-lg" name="marital" id="customer-marital" onchange="#" required>
                                    <option value="">Choose... </option>
                                    <option value="Single">Single </option>
                                    <option value="Married">Married</option>
                                      <option value="Divorsed">Divorsed</option>
                                        <option value="Other">Other</option>
                                  </select>
                              </div>


                              <div class="form-group">
                                  <label for="customer-Income">Income<span class="required">*</span></label>
                                  <input   placeholder="Enter income"
                                            id="customer-Income"
                                            required
                                            type="float"
                                            name="income"
                                            spellcheck="false"
                                            class="form-control"
                                             />
                                    </div>

                                    <div class="form-group">
                                        <label for="customer-bonds">Other Bonds<span class="required"></span></label>
                                        <textarea placeholder="Enter Other Bonds"
                                                  style="resize: vertical"
                                                  id="customer-bonds"
                                                  name="otherbonds"
                                                  rows="5" spellcheck="false"
                                                  class="form-control autosize-target text-left">


                                                  </textarea>

                                                </div>

                                    <div class="form-group">
                                        <label for="customer-business">Business<span class="required"></span></label>
                                        <input   placeholder="Enter Business"
                                                  id="customer-business"

                                                  name="business"
                                                  spellcheck="false"
                                                  class="form-control"
                                                   />
                                          </div>

                                          <div class="form-group">
                                              <label for="customer-empname">Employer Name<span class="required"></span></label>
                                              <input   placeholder="Enter Emplyer Name"
                                                        id="customer-empname"

                                                        name="employername"
                                                        spellcheck="false"
                                                        class="form-control"
                                                         />
                                                </div>

                    <div class="form-group">
                        <label for="customer-designation">Designation<span class="required"></span></label>
                        <input   placeholder="Enter Business"
                                  id="customer-designation"

                                  name="designation"
                                  spellcheck="false"
                                  class="form-control"
                                   />
                          </div>


                          <div class="form-group">
                              <label for="customer-specialabilities">Special Abilities<span class="required"></span></label>
                              <input   placeholder="Enter special abilities"
                                        id="customer-specialabilities"

                                        name="specialabilities"
                                        spellcheck="false"
                                        class="form-control"
                                         />
                                </div>

<hr>
<h3>Spouse Details</h3>
                                <div class="form-group">
                                    <label for="customer-spousenic">Spouse NIC<span class="required">*</span></label>
                                    <input   placeholder="Enter spouse nic"
                                              id="customer-spousenic"
                                              required
                                              name="spousenic"
                                              spellcheck="false"
                                              class="form-control"
                                               />
                                      </div>
                                      <p id="error1" style="color: red;"></p>
                                      <div class="form-group">
                                    <label for="customer-spousename">Spouse Name<span class="required">*</span></label>
                                    <input   placeholder="Enter spouse name"
                                              id="customer-spousename"
                                              required
                                              name="spousename"
                                              spellcheck="false"
                                              class="form-control"
                                               />

                                             </div>

                                <div class="form-group">
                                                <label for="customer-spousebirthday">spouse Birthday<span class="required">*</span></label>
                                                <input   placeholder="mm/dd/yy"
                                                          id="customer-spousebirthday"
                                                          required
                                                          type="date"
                                                          name="spousebirthday"
                                                          spellcheck="false"
                                                          class="form-control"
                                                           />
                                                  </div>

                                                  <div class="form-group">
                                                      <label for="customer-spouseaddress">spouse Address<span class="required">*</span></label>
                                                      <textarea placeholder="Enter spouse address"
                                                                style="resize: vertical"
                                                                id="customer-spouseaddress"
                                                                required
                                                                name="spouseaddress"
                                                                rows="5" spellcheck="false"
                                                                class="form-control autosize-target text-left">


                                                                </textarea>

                                                              </div>


                                                                <div class="form-group">
                                                              <label for="customer-spousetelephone">Spouse Telephone<span class="required">*</span></label>
                                                              <input   placeholder="Enter spouse name"
                                                                        id="customer-spousetelephone"
                                                                        required
                                                                        type="telephone"
                                                                        name="spousetelephone"
                                                                        spellcheck="false"
                                                                        class="form-control"
                                                                         />

                                                                       </div>
      <div class="form-group">
                  <label for="customer-spouserelationship">spouse Relationship<span class="required">*</span></label>

                  <select class="form-control form-control-lg" name="spouserelationship" id="customer-spouserelationship" onchange="#" required>
                          <option value="">Choose... </option>
                          <option value="Husband">Husband</option>
                          <option value="Wife">Wife</option>
                            <option value="Guardian">Guardian</option>
                              <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="customer-spousebusiness">spouse Business<span class="required"></span></label>
                        <input   placeholder="Enter spouse Business"
                                  id="customer-spousebusiness"

                                  name="spousebusiness"
                                  spellcheck="false"
                                  class="form-control"
                                   />
                          </div>

                          <div class="form-group">
                              <label for="customer-spouseempname">spouse Employer Name<span class="required"></span></label>
                              <input   placeholder="Enter spouse Emplyer Name"
                                        id="customer-spouseempname"

                                        name="spouseemployername"
                                        spellcheck="false"
                                        class="form-control"
                                         />
                                </div>

    <div class="form-group">
        <label for="customer-spousedesignation">spouse Designation<span class="required"></span></label>
        <input   placeholder="Enter spouse Business"
                  id="customer-spousedesignation"

                  name="spousedesignation"
                  spellcheck="false"
                  class="form-control"
                   />
          </div>


          <div class="form-group">
              <label for="customer-spousespecialabilities">spouse Special Abilities<span class="required"></span></label>
              <input   placeholder="Enter spouse special abilities"
                        id="customer-spousespecialabilities"

                        name="spousespecialabilities"
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
              <li><a href="/customers"><i class="fa fa-user-o" aria-hidden="true"></i> My customers</a></li>

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
