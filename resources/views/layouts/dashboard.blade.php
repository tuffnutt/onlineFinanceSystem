

<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Online Finance System</title>

  <!-- Styles -->

  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>


  .filterable {
      margin-top: 15px;
  }
  .filterable .panel-heading .pull-right {
      margin-top: -1px;
  }
  .filterable .filters input[disabled] {
      background-color: transparent;
      border: none;
      cursor: auto;
      box-shadow: none;
      padding: 0;
      height: auto;
  }
  .filterable .filters input[disabled]::-webkit-input-placeholder {
      color: #333;
  }
  .filterable .filters input[disabled]::-moz-placeholder {
      color: #333;
  }
  .filterable .filters input[disabled]:-ms-input-placeholder {
      color: #333;
  }



  .navbar-static-top {
  margin-bottom:20px;
}

i {
  font-size:16px;
}

.nav > li > a {
  color:#787878;
}

footer {
  margin-top:20px;
  padding-top:20px;
  padding-bottom:20px;
  background-color:#efefef;
}

/* count indicator near icons */
.nav>li .count {
  position: absolute;
  bottom: 12px;
  right: 6px;
  font-size: 10px;
  font-weight: normal;
  background: rgba(51,200,51,0.55);
  color: rgba(255,255,255,0.9);
  line-height: 1em;
  padding: 2px 4px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  -ms-border-radius: 10px;
  -o-border-radius: 10px;
  border-radius: 10px;
}

/* indent 2nd level */
.list-unstyled li > ul > li {
   margin-left:10px;
   padding:8px;
}

  </style>

 </head>

<body>
  <!-- Header -->
  <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-toggle"></span>
        </button>
        <a class="navbar-brand" href="#">Finance System</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">


          <li class="dropdown">
            <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i>  {{ Auth::user()->name }}<span class="caret"></span></a>
            <ul id="g-account-menu" class="dropdown-menu" role="menu">
              <li><a href="/users/{{Auth::user()->id}}">My Profile</a></li>
              <li><a href="/changePassword">Change password</a></li>
            </ul>
          </li>
          <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>

        </ul>
      </div>
    </div><!-- /container -->
  </div>
  <!-- /Header -->

  <!-- Main -->
  <div class="container">
  <div class="row">
      <div class="col-md-3 col-sm-3 col-lg-3">
        <!-- Left column -->
        <a href="/home"><strong><i class="glyphicon glyphicon-home"></i> Home</strong></a>

        <hr>
  @if(Auth::user()->user_role_id<5)
        <ul class="list-unstyled">

          @if(Auth::user()->user_role_id<3)
          <li class="nav-header">
          <a href="#" data-toggle="collapse" data-target="#menu6">
            <h5>Admin <i class="glyphicon glyphicon-chevron-right"></i></h5>
            </a>

              <ul class="list-unstyled collapse" id="menu6">
                  <li><a href="/branches"><i class="glyphicon glyphicon-circle"></i> Branch List</a></li>
                  <li><a href="/users"><i class="glyphicon glyphicon-circle"></i> User List</a></li>
              </ul>
          </li>
          @endif

          <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">
            <h5>Loans <i class="glyphicon glyphicon-chevron-down"></i></h5>
            </a>
              <ul class="list-unstyled collapse in" id="userMenu">

                  <li><a href="/loans/create"><i class="glyphicon glyphicon-plus"></i> New Loan {{--<span class="badge badge-info">4</span>--}}</a></li>
                  <li><a href="/loans/loanUpdate"><i class="glyphicon glyphicon-th"></i> Update</a></li>
                  <li><a href="/loans"><i class="glyphicon glyphicon-search"></i> Search</a></li>
                    @if(Auth::user()->user_role_id<3)
                  <li><a href="/loans"><i class="glyphicon glyphicon-trash"></i> Deactivate</a></li>
                  <li><a href="/customers/savingsWithdraw"><i class="glyphicon glyphicon-usd"></i> Withdraw</a></li>
                    @endif
              </ul>
          </li>

          <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#insuMenu">
            <h5>Insuarance <i class="glyphicon glyphicon-chevron-right"></i></h5>
            </a>
              <ul class="list-unstyled collapse" id="insuMenu">

                  <li><a href="/customers/insuaranceWithdraw"><i class="glyphicon glyphicon-search"></i> Search</a></li>
                  <li><a href="/customers/insUpdate"><i class="glyphicon glyphicon-th"></i> Update</a></li>
                  <li><a href="/customers/insuaranceWithdraw"><i class="glyphicon glyphicon-usd"></i> Withdraw</a></li>

              </ul>
          </li>


          <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2">
            <h5>Reports <i class="glyphicon glyphicon-chevron-right"></i></h5>
            </a>

              <ul class="list-unstyled collapse" id="menu2">
                  <li><a href="/reports/showrepayment">Repayment Sheet</a>
                  </li>
                  <li><a href="/reports/showattendence">Attendence Sheet</a>
                  </li>
                    @if(Auth::user()->user_role_id<2)
                  <li><a href="/reports/showloanDetail">Loan Detail Report</a>
                  </li>
                  @endif
                  <li><a href="/reports/showadvancedLoanDetail">Advanced Detail Report</a>
                  </li>
                  <li><a href="/reports/showloanSummary">Loan Summary Report</a>
                  </li>
                  <li><a href="/reports/showdefaltLoan">Defalt Loan Report</a>
                  </li>
                  <li><a href="/reports/showcollection">Collection Reprt</a>
                  </li>
                  <li><a href="/reports/showpayment">Payment Report</a>
                  </li>
              </ul>
          </li>
          <li class="nav-header">
          <a href="#" data-toggle="collapse" data-target="#menu3">
            <h5>Accounts <i class="glyphicon glyphicon-chevron-right"></i></h5>
            </a>

              <ul class="list-unstyled collapse" id="menu3">
                  <li><a href="transactions"><i class="glyphicon glyphicon-circle"></i> Transactions</a></li>
                  <li><a href="transactions/create"><i class="glyphicon glyphicon-circle"></i> New Transactions</a></li>
                  <li><a href="#"><i class="glyphicon glyphicon-circle"></i> Bill Print</a></li>
              </ul>
          </li>

          <li class="nav-header">
          <a href="#" data-toggle="collapse" data-target="#menu4">
            <h5>Customer <i class="glyphicon glyphicon-chevron-right"></i></h5>
            </a>

              <ul class="list-unstyled collapse" id="menu4">
                  <li><a href="/customers/create"><i class="glyphicon glyphicon-circle"></i> Add Customer</a></li>
                  <li><a href="/customers"><i class="glyphicon glyphicon-circle"></i> Search Customer</a></li>
              </ul>
          </li>
          <li class="nav-header">
          <a href="#" data-toggle="collapse" data-target="#menu5">
            <h5>Creations <i class="glyphicon glyphicon-chevron-right"></i></h5>
            </a>

              <ul class="list-unstyled collapse" id="menu5">
                  @if(Auth::user()->user_role_id<4)
                  <li><a href="/centers/create"><i class="glyphicon glyphicon-circle"></i> Add Center</a></li>
                  @endif
                  <li><a href="/centers"><i class="glyphicon glyphicon-circle"></i> Center List</a></li>
                  <li><a href="/groups/create"><i class="glyphicon glyphicon-circle"></i> Add Group</a></li>
                  <li><a href="/groups"><i class="glyphicon glyphicon-circle"></i> Group List</a></li>
              </ul>
          </li>

        </ul>

        <hr>

        <a href="#"><strong><i class="glyphicon glyphicon-log-out"></i> Logout</strong></a>

        <hr>

        <ul class="nav nav-pills nav-stacked">
          <li class="nav-header"></li>
          <li><a href="#"><i class="glyphicon glyphicon-list"></i> Collection Sheet</a></li>
          <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Print Bill</a></li>

        </ul>

        <hr>
          @if(Auth::user()->user_role_id<2)
        <ul class="nav nav-stacked">
          <li class="active"><a href="http://bootply.com" title="The Bootstrap Playground" target="ext">Playground</a></li>
          <li><a href="/tagged/bootstrap-3">Bootstrap 3</a></li>
          <li><a href="/61518" title="Bootstrap 3 Panel">Panels</a></li>
          <li><a href="/61521" title="Bootstrap 3 Icons">Glyphicons</a></li>
          <li><a href="/61523" title="Bootstrap 3 ListGroup">List Groups</a></li>
          <li><a href="#">GitHub</a></li>
          <li><a href="/61518" title="Bootstrap 3 Slider">Carousel</a></li>
          <li><a href="/62603">Layout</a></li>
        </ul>
        @endif
        @endif
        <hr>
    	</div><!-- /col-3 -->


      <div class="col-md-9 col-lg-9 col-sm-9">
          @yield('content')

        </div>

    	</div><!--/col-span-9-->

  </div>

  </div>
  <!-- /Main -->

  <footer class="text-center">powered by tuffnut.CODE <a href="http://www.tuffnut.lk"><strong> tuffnut.lk</strong></a></footer>

  <div class="modal" id="addWidgetModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Add Widget</h4>
        </div>
        <div class="modal-body">
          <p>Add a widget stuff here..</p>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
          <a href="#" class="btn btn-primary">Save changes</a>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dalog -->
  </div><!-- /.modal -->


<script>

  $(".alert").addClass("in").fadeOut(4500);

/* swap open/close side menu icons */
$('[data-toggle=collapse]').click(function(){
      // toggle icon
  	$(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
});




/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});





$(document).ready(function () {


            $("#customer-nic").keyup(function () {
                //Clear Existing Details
                $("#error").html("");
                $("#gender").html("");
                $("#year").html("");
                $("#month").html("");
                $("#day").html("");

                var NICNo = $("#customer-nic").val();
                var dayText = 0;
                var year = "";
                var month = 0;
                var day = "";
                var gender = "";
                if (NICNo.length != 10 && NICNo.length != 12) {
                    $("#error").html("Invalid NIC NO");
                } else if (NICNo.length == 10 && !$.isNumeric(NICNo.substr(0, 9))) {
                    $("#error").html("Invalid NIC NO");
                }
                else {
                    // Year
                    if (NICNo.length == 10) {
                        year = "19" + NICNo.substr(0, 2);
                        dayText = parseInt(NICNo.substr(2, 3));
                    } else {
                        year = NICNo.substr(0, 4);
                        dayText = parseInt(NICNo.substr(4, 3));
                    }

                    // Gender
                    if (dayText > 500) {
                        gender = "Female";
                        dayText = dayText - 500;
                    } else {
                        gender = "Male";
                    }

                    // Day Digit Validation
                    if (dayText < 1 && dayText > 366) {
                        $("#error").html("Invalid NIC NO");
                    } else {

                        //Month
                        if (dayText > 335) {
                            day = dayText - 335;
                            month = 12;
                        }
                        else if (dayText > 305) {
                            day = dayText - 305;
                            month = 11;
                        }
                        else if (dayText > 274) {
                            day = dayText - 274;
                            month = 10;
                        }
                        else if (dayText > 244) {
                            day = dayText - 244;
                            month = 09;
                        }
                        else if (dayText > 213) {
                            day = dayText - 213;
                            month = 08;
                        }
                        else if (dayText > 182) {
                            day = dayText - 182;
                            month = 07;
                        }
                        else if (dayText > 152) {
                            day = dayText - 152;
                            month = 06;
                        }
                        else if (dayText > 121) {
                            day = dayText - 121;
                            month = 05;
                        }
                        else if (dayText > 91) {
                            day = dayText - 91;
                            month = 04;
                        }
                        else if (dayText > 60) {
                            day = dayText - 60;
                            month = 03;
                        }
                        else if (dayText < 32) {
                            month = 01;
                            day = dayText;
                        }
                        else if (dayText > 31) {
                            day = dayText - 31;
                            month = 02;
                        }

                        // Show Details
                        $("#gender").html("Gender : " + gender);
                        $("#year").html("Year : " + year);
                        $("#month").html("Month : " + month);
                        $("#day").html("Day :" + day);

                        document.getElementById("customer-birthday").value = month+"/"+day+"/"+year;

                    }
                }
            });
        });




        $(document).ready(function () {


                    $("#customer-spousenic").keyup(function () {
                        //Clear Existing Details
                        $("#error1").html("");
                        $("#gender").html("");
                        $("#year").html("");
                        $("#month").html("");
                        $("#day").html("");

                        var NICNo = $("#customer-spousenic").val();
                        var dayText = 0;
                        var year = "";
                        var month = 0;
                        var day = "";
                        var gender = "";
                        if (NICNo.length != 10 && NICNo.length != 12) {
                            $("#error1").html("Invalid NIC NO");
                        } else if (NICNo.length == 10 && !$.isNumeric(NICNo.substr(0, 9))) {
                            $("#error1").html("Invalid NIC NO");
                        }
                        else {
                            // Year
                            if (NICNo.length == 10) {
                                year = "19" + NICNo.substr(0, 2);
                                dayText = parseInt(NICNo.substr(2, 3));
                            } else {
                                year = NICNo.substr(0, 4);
                                dayText = parseInt(NICNo.substr(4, 3));
                            }

                            // Gender
                            if (dayText > 500) {
                                gender = "Female";
                                dayText = dayText - 500;
                            } else {
                                gender = "Male";
                            }

                            // Day Digit Validation
                            if (dayText < 1 && dayText > 366) {
                                $("#error1").html("Invalid NIC NO");
                            } else {

                                //Month
                                if (dayText > 335) {
                                    day = dayText - 335;
                                    month = 12;
                                }
                                else if (dayText > 305) {
                                    day = dayText - 305;
                                    month = 11;
                                }
                                else if (dayText > 274) {
                                    day = dayText - 274;
                                    month = 10;
                                }
                                else if (dayText > 244) {
                                    day = dayText - 244;
                                    month = 09;
                                }
                                else if (dayText > 213) {
                                    day = dayText - 213;
                                    month = 08;
                                }
                                else if (dayText > 182) {
                                    day = dayText - 182;
                                    month = 07;
                                }
                                else if (dayText > 152) {
                                    day = dayText - 152;
                                    month = 06;
                                }
                                else if (dayText > 121) {
                                    day = dayText - 121;
                                    month = 05;
                                }
                                else if (dayText > 91) {
                                    day = dayText - 91;
                                    month = 04;
                                }
                                else if (dayText > 60) {
                                    day = dayText - 60;
                                    month = 03;
                                }
                                else if (dayText < 32) {
                                    month = 01;
                                    day = dayText;
                                }
                                else if (dayText > 31) {
                                    day = dayText - 31;
                                    month = 02;
                                }

                                // Show Details
                              //  $("#gender").html("Gender : " + gender);
                                //$("#year").html("Year : " + year);
                                //$("#month").html("Month : " + month);
                                //$("#day").html("Day :" + day);

                                document.getElementById("customer-spousebirthday").value = month+"/"+day+"/"+year;

                            }
                        }
                    });
                });




</script>

</body>

</html>
