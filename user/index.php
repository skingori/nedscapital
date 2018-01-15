<?php

//Start our session.
session_start();

if (isset($_SESSION['logname']) && ($_SESSION['rank'])) {
    switch($_SESSION['rank']) {

        case 1:
            header('location:../admin/index.php');//redirect to  page
            break;
        case 3:
            header('location:../officer/index.php');//redirect to  page
            break;

    }
}elseif(!isset($_SESSION['logname']) && !isset($_SESSION['rank'])) {
    header('Location:../sessions.php');
}
else
{

    header('Location:index.php');
}

include '../connection/db.php';
$username=$_SESSION['logname'];
//

//make user update profile
$query = "SELECT * FROM `Login_Table` WHERE Login_Username='$username'";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$rows = mysqli_num_rows($result);

$rowCheck = mysqli_num_rows($result);
$row= mysqli_fetch_array($result);

if($row['Sirname']=="" AND $row['Firstname']=="") {

    header('location:profile.php');//redirect to  page

}else{

    null;

}

//


//Expire the session if user is inactive for 30
//minutes or more.
$expireAfter = 30;

//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){

    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];

    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;

    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        session_unset();
        session_destroy();
        unset($_SESSION['userSession']);

    }

}

//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();

//Send error message//
if (isset($_GET['error'])){

    $msg = "<div class='text-danger'>
    <strong class='glyphicon glyphicon-info-sign'></strong>&nbsp;Sorry ,There was an error in your form.
    </div>";
}


//
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Welcome | Ned Home</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <script src="../assets/js/chart-master/Chart.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
*********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="index.php" class="logo"><b>NEDS CAPITAL</b></a>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- inbox dropdown start-->
                <li id="header_inbox_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-theme">1</span>
                    </a>
                    <ul class="dropdown-menu extended inbox">
                        <div class="notify-arrow notify-arrow-green"></div>
                        <li>
                            <p class="green">You have 5 new messages</p>
                        </li>

                        <li>
                            <a href="index.php#">
                                <span class="photo"><img alt="avatar" src="../assets/img/ui-sam.jpg"></span>
                                <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                <span class="message">
                                    Please, answer asap.
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php#">See all messages</a>
                        </li>
                    </ul>
                </li>
                <!-- inbox dropdown end -->
            </ul>
            <!--  notification end -->
        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="../logout.php?logout">Logout</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
   MAIN SIDEBAR MENU
   *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href=""><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered"><?php echo $username;?></h5>

                <li class="mt">
                    <a class="active" href="index.php">
                        <i class="fa fa-home"></i>
                        <span>Homepage</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-users"></i>
                        <span>Preferences</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="">Profile</a></li>
                        <li><a  href="../logout.php?logout">Logout</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-file-pdf-o"></i>
                        <span>Application</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="preview.php">Applied loans</a></li>
                        <li><a  href="">Approved Loans</a></li>
                        <li><a  href="">Declined Loans</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="" >
                        <i class="fa fa-envelope"></i>
                        <span>Offer Letter</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-book"></i>
                        <span>My Reports</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="preview.php">My Payments</a></li>
                    </ul>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->

    <section id="main-content">
        <section class="wrapper">

            <div class="row">

                <div class="col-lg-9 main-chart">

                    <div class="form-panel" style="font-family: San Francisco">
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ?>
                        <h4 class="mb">LOAN APPLICATION FORM</h4>

                        <form class="form-horizontal style-form" method="post" action="process.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Loan Type:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="loan_type" name="Loan_type" required>
                                        <option selected></option>
                                        <option value="Business Loan">Business Loan</option>
                                        <option value="Personal Loan">Personal Loan</option>
                                        <option value="LPO Financing">LPO Financing</option>
                                        <option value="Invoice Discounting">Invoice Discounting</option>
                                        <option value="Cheque Discounting">Cheque Discounting</option>
                                        <option value="Contract Financing">Contract Financing</option>
                                        <option value="Bind Bond Financing">Bind Bond Financing</option>
                                    </select>
                                </div>
                            </div>
                            <div id="bank">
                                <h5 id="label">SECTION B: BUSINESS DETAILS</h5>
                                <div class="form-group" id="b_name">
                                    <label class="col-sm-2 col-sm-2 control-label">Business Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_bus_name" placeholder="The registered name of your business">
                                    </div>
                                </div>
                                <div class="form-group" id="b_nature">
                                    <label class="col-sm-2 col-sm-2 control-label">Business Nature:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_bus_natu" placeholder="Type or general category of business or commerce">
                                    </div>
                                </div>
                                <div class="form-group" id="address">
                                    <label class="col-sm-2 col-sm-2 control-label">Address:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_bus_address" placeholder="365-10954 NAIROBI">
                                    </div>
                                </div>
                                <div class="form-group" id="address1">
                                    <label class="col-sm-2 col-sm-2 control-label">Map:</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="Loan_bus_map" accept="image/*">
                                        <span class="help-block">Upload the scan of the sketch map</span>
                                    </div>
                                </div>
                                <div class="form-group" id="town">
                                    <label class="col-sm-2 col-sm-2 control-label">Town:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_bus_town" placeholder="The town in which the business resides">
                                    </div>
                                </div>
                                <div class="form-group" id="building">
                                    <label class="col-sm-2 col-sm-2 control-label">Building:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_bus_building" placeholder="Example: JOHN DOE BUILDING">
                                    </div>
                                </div>
                                <div class="form-group" id="street">
                                    <label class="col-sm-2 col-sm-2 control-label">Street:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_bus_street" placeholder="Example: Ronald Ngala street">
                                    </div>
                                </div>
                                <div class="form-group" id="business">
                                    <label class="col-sm-2 col-sm-2 control-label">Yrs in Business:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_bus_yrs" placeholder="Example: 27 Years">
                                    </div>
                                </div>
                            </div>

                            <div id="loan">
                                <h5>SECTION C:LOAN PARTICULARS</h5>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Amount Applied for (Kes):</label>
                                    <div class="col-sm-10 has-error">
                                        <input class="form-control" id="Loan_amount" type="number" placeholder="Example: 30000" name="Loan_amount" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Purpose:</label>
                                    <div class="col-sm-10 has-error">
                                        <input class="form-control" id="Loan_purpose" type="text" placeholder="Example: To buy a house" name="Loan_purpose" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Tenure/Period (Days)</label>
                                    <div class="col-sm-10 has-error">
                                        <input class="form-control" id="Loan_tenure" type="number" placeholder="Example: 30" name="Loan_tenure" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Monthly Repayments (Kes):</label>
                                    <div class="col-sm-10 has-error">
                                        <input readonly="" class="form-control" id="Loan_repayments" type="number" name="Loan_repayments" required>
                                    </div>
                                </div>
                            </div>
                            <div id="other" style="display:none;">
                                <h4 id="project">MORE DETAILS</h4>
                                <div class="form-group has-warning" id="p_cost" >
                                    <label class="col-sm-2 col-sm-2 control-label">Cost of Project (Kes):</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="" type="number" placeholder="" name="Loan_project_cost">
                                        <span class="help-block">If you want to finance the project</span>
                                    </div>
                                </div>
                                <div class="form-group has-warning" id="p_cont">
                                    <label class="col-sm-2 col-sm-2 control-label">Own Contribution (Kes):</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputSuccess" type="number" placeholder="Amount you've contributed for your project" name="Loan_project_contrib">
                                    </div>
                                </div>
                            </div>
                            <div id="guarantor">
                                <h5>GUARANTOR DETAILS</h5>
                                <div class="form-group" id="b_nature">
                                    <label class="col-sm-2 col-sm-2 control-label">Full Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_guarantor_name" placeholder="Name of the guarantor" required>
                                    </div>
                                </div>
                                <div class="form-group" id="b_nature">
                                    <label class="col-sm-2 col-sm-2 control-label">ID NO:</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="Loan_guarantor_id" placeholder="ID NO of the guarantor">
                                    </div>
                                </div>
                                <div class="form-group" id="b_nature">
                                    <label class="col-sm-2 col-sm-2 control-label">Tel NO:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_guarantor_mobile" placeholder="Working contact of the guarantor" required>
                                    </div>
                                </div>
                                <div class="form-group" id="b_nature">
                                    <label class="col-sm-2 col-sm-2 control-label">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="Loan_guarantor_email" placeholder="Example: john.doe@email.com" required>
                                    </div>
                                </div>
                                <div class="form-group" id="b_nature">
                                    <label class="col-sm-2 col-sm-2 control-label">Current Residence:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Loan_guarantor_resd" placeholder="Current residing place of the guarantor" required>
                                    </div>
                                </div>
                                <div class="form-group" id="b_nature">
                                    <label class="col-sm-2 col-sm-2 control-label">Residence Type:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="Loan_guarantor_rstat" required>
                                            <option selected></option>
                                            <option value="Rented">Rented Residence</option>
                                            <option value="Personal">Personal Residence</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="btn-group-justified centered">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="get_loan">Confirm Application</button>
                                    <strong>STEP 2/3</strong>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /col-lg-9 END SECTION MIDDLE -->


                <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->

                <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                    <h3>LOAN CALCULATOR</h3>

                    <!-- First Action-->
                    <div class="desc">
                        <p class="has-warning">
                            <label>Note: Amount above Ksh 33000 </label>
                        </p>
                        <p class="has-success">
                            <input type="number" class="input-sm form-control" id="amount" name="amount" placeholder="Loan Amount">
                        </p>
                        <p class="has-success">
                            <input type="text" id="months" class="input-sm form-control bg-danger" placeholder="Months">
                        </p>
                        <!--<p class="has-success">
                            <input type="text" id="years" class="input-sm form-control" placeholder="Years">
                        </p>-->
                        <p class="has-success" hidden>
                            <input type="text" id="interest" class="input-sm form-control " placeholder="Interest Rate" value="21.5">
                        </p>
                        <!--<p class="has-success">
                            <input type="text" id="down" class="input-sm form-control" placeholder="Down Payment">
                        </p>-->
                        <p class="has-success">
                            <label>Total Payment= <strong style="color: #000000" id="output">00.00</strong></label>
                        </p>

                        <div>
                            <button type="button" class="btn btn-clear-g btn-block" onclick="myFunction()">Calculate</button>
                        </div>


                    </div>
                    <h3>NOTIFICATIONS</h3>

                    <!-- First Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p><muted>2 Minutes Ago</muted><br/>
                                <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Second Action -->

                    <!-- Third Action -->

                    <!-- Fourth Action -->

                    <!-- Fifth Action -->

                    <!-- USERS ONLINE SECTION -->
                    <h3>ONLINE USERS</h3>
                    <!-- First Member -->
                    <div class="desc">
                        <div class="thumb">
                            <img class="img-circle" src="../assets/img/ui-sam.jpg" width="35px" height="35px" align="">
                        </div>
                        <div class="details">
                            <p><a href="#">DIVYA MANIAN</a><br/>
                                <muted>Available</muted>
                            </p>
                        </div>
                    </div>
                    <!-- Second Member -->

                    <!-- Third Member -->

                    <!-- Fourth Member -->

                    <!-- Fifth Member -->

                    <!-- CALENDAR-->
                    <div id="calendar" class="mb">
                        <div class="panel green-panel no-margin">
                            <div class="panel-body">
                                <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                    <div class="arrow"></div>
                                    <h3 class="popover-title" style="disadding: none;"></h3>
                                    <div id="date-popover-content" class="popover-content"></div>
                                </div>
                                <div id="my-calendar"></div>
                            </div>
                        </div>
                    </div><!-- / calendar -->

                </div><!-- /col-lg-3 -->

            </div><! --/row -->
        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            Ned Co @ 2017 All rights Reserved
            <a href="index.php#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/jquery-1.8.3.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../assets/js/jquery.scrollTo.min.js"></script>
<script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="../assets/js/jquery.sparkline.js"></script>


<!--common script for all pages-->
<script src="../assets/js/common-scripts.js"></script>

<script type="text/javascript" src="../assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="../assets/js/gritter-conf.js"></script>

<!--script for this page-->
<script src="../assets/js/sparkline-chart.js"></script>
<script src="../assets/js/zabuto_calendar.js"></script>


<!--<script type="text/javascript">
    $(document).ready(function () {
    var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Dashgum!',
        // (string | mandatory) the text inside the notification
        text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Free version for <a href="http://blacktie.co" target="_blank" style="color:#ffd777">BlackTie.co</a>.',
        // (string | optional) the image to display on the left
        //image: '../assets/img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: true,
        // (int | optional) the time you want it to be alive for before fading out
        time: '',
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
    });

    return false;
    });
</script>-->
<script>
    $(document).ready(function(){

        $('#Loan_amount').keyup(function(){

            if($(this).val() <= 33000){

                $('#Loan_repayments').val($('#Loan_amount').val() / 80 * (100)+500);

            }else{
                $('#Loan_repayments').val($('#Loan_amount').val() / 78.5 *(100));
            }

        });
    });
</script>

<script language="JavaScript">
    <!--
    function showpay() {
        if ((document.calc.loan.value == null || document.calc.loan.value.length == 0) ||
            (document.calc.months.value == null || document.calc.months.value.length == 0)
            ||
            (document.calc.rate.value == null || document.calc.rate.value.length == 0))
        { document.calc.pay.value = "Incomplete data";
        }
        else
        {
            var princ = document.calc.loan.value;
            var term  = document.calc.months.value;
            var intr   = document.calc.rate.value / 1200;
            document.calc.pay.value = princ * intr / (1 - (Math.pow(1/(1 + intr), term)));
        }

// payment = principle * monthly interest/(1 - (1/(1+MonthlyInterest)*Months))

    }

    // -->
</script>

<script type="application/javascript">
    $(document).ready(function () {
        $("#date-popover").popover({html: true, trigger: "manual"});
        $("#date-popover").hide();
        $("#date-popover").click(function (e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function () {
                return myDateFunction(this.id, false);
            },
            action_nav: function () {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [
                {type: "text", label: "Special event", badge: "00"},
                {type: "block", label: "Regular event", }
            ]
        });
    });


    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
</script>

<script>
    function myFunction() {
        var loan = $('#amount').val(),
            month = $('#months').val(),
            int = $('#interest').val(),
            years = $('#years').val(),
            down = $('#down').val(),
            amount = parseInt(loan),
            months = parseInt(month),
            down = parseInt(down),
            annInterest = parseFloat(int),
            monInt = annInterest / 78.5,
            calculation = ((monInt + (monInt / (Math.pow((1 + monInt), months) -1))) * (amount - (down || 0))).toFixed(2);

        document.getElementById("output").innerHTML = calculation;
    }

    $(function(){
        var month = $(this).val(),
            doneTypingInterval = 500,
            months = parseInt(month),
            typingTimer;

        $('#months').keyup(function(){
            month = $(this).val();
            months = parseInt(month);

            clearTimeout(typingTimer);
            if (month) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });

        function doneTyping () {
            $('#years').val(months/12);
        }
    })

    $(function(){
        var month = $(this).val(),
            doneTypingInterval = 500,
            months = parseInt(month),
            typingTimer;

        $('#months').keyup(function(){
            month = $(this).val();
            months = parseInt(month);

            clearTimeout(typingTimer);
            if (month) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });

        function doneTyping () {
            $('#years').val(months/12);
        }
    })

    $(function(){
        var year = $(this).val(),
            doneTypingInterval = 500,
            years = parseInt(year),
            typingTimer;

        $('#years').keyup(function(){
            year = $(this).val();
            myears = parseInt(year);

            clearTimeout(typingTimer);
            if (year) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });

        function doneTyping () {
            $('#months').val(year * 12);
        }
    })
</script>
<script type="text/javascript">
    $(function () {
        $("#loan_type").change(function () {
            if ($(this).val() == "Personal Loan"){
                $("#label").hide();
                $("#b_name").hide();
                $("#b_nature").hide();
                $("#address").hide();
                $("#address1").hide();
                $("#building").hide();
                $("#business").hide();
                $("#street").hide();
                $("#town").hide();
                //for projest contribution
                $("#other").hide();
                //$("#p_cont").hide();
                //$("#p_cost").hide();


            }else if ($(this).val() == "Business Loan"){
                $("#label").show();
                $("#b_name").show();
                $("#b_nature").show();
                $("#address").show();
                $("#address1").show();
                $("#building").show();
                $("#business").show();
                $("#street").show();
                $("#town").show();
                //
                $("#other").show();
                //$("#p_cont").show();
                //$("#p_cost").show();
            }
            else {
                $("#label").show();
                $("#b_name").show();
                $("#b_nature").show();
                $("#address").show();
                $("#building").show();
                $("#business").show();
                $("#street").show();
                $("#town").show();
                //For contribution
                $("#other").hide();
                //$("#p_cont").hide();
                //$("#p_cost").hide();
            }
        });
    });
</script>
</body>
</html>
