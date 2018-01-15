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
if (isset($_GET['success'])){

    $msg = "<div class='text-info'>
    <strong class='glyphicon glyphicon-info-sign'></strong>&nbsp;Congratulations,we're almost done.
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
    <!-- FOR DATA TABLES -->
    <link rel="stylesheet" href="../custom/dist/simplePagination.css" />
    <!-- FOR DATA TABLES -->


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
                <!-- settings start -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
                        <i class="fa fa-tasks"></i>
                        <span class="badge bg-theme">1</span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <div class="notify-arrow notify-arrow-green"></div>
                        <li>
                            <p class="green">You have 1 pending tasks</p>
                        </li>
                        <li>
                            <a href="index.php#">
                                <div class="task-info">
                                    <div class="desc">DashGum Admin Panel</div>
                                    <div class="percent">40%</div>
                                </div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li class="external">
                            <a href="#">See All Tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- settings end -->
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
                        <span>Get Back Home</span>
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
                        <span>Loan Application</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="preview.php">Preview</a></li>
                        <li><a  href="">Approved Loans</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-cogs"></i>
                        <span>Components</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="">Notifications</a></li>
                        <li><a  href="">Alerts</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class=" fa fa-question-circle"></i>
                        <span>Get Help Here</span>
                    </a>
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

                    <div class="container" style="font-family: San Francisco"><h4>STEP 3/3: APPLICATION FORM</h4></div>

                    <div class="form-panel" style="font-family: San Francisco">
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ?>

                            <h5 id="label">LOANS IN OTHER FINANCIAL INSTITUTIONS</h5>
                            <?php

                            $limit = 3;
                            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                            $start_from = ($page-1) * $limit;

                            $sql = "SELECT * FROM Other_Loans WHERE User_email = '$username' ORDER BY id ASC LIMIT $start_from, $limit";
                            $rs_result = mysqli_query($con, $sql);
                            ?>
                            <table class="table table-striped table-responsive">
                                <thead class="alert-info">
                                <tr>
                                    <th>Institution</th>
                                    <th>Amount</th>
                                    <th>Date Advanced</th>
                                    <th>Repayment</th>
                                    <th>Outstanding Amount</th>
                                    <th><i class="glyphicon glyphicon-info-sign alert-danger"></i></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($rs_result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row["Institution"]; ?></td>
                                        <td><?php echo $row["Loan_amount"]; ?></td>
                                        <td><?php echo $row["Date_advanced"]; ?></td>
                                        <td><?php echo $row["Repayment_period"]; ?></td>
                                        <td><?php echo $row["Outstanding_amount"]; ?></td>
                                        <td><a href="del.php?loa='<?php echo $row["Id"]; ?>' " class="glyphicon glyphicon-remove"></a></td>
                                    </tr>
                                    <?php
                                };
                                ?>
                                </tbody>
                                <tfoot>
                                <tr class="alert-info">
                                    <th>Institution</th>
                                    <th>Amount</th>
                                    <th>Date Advanced</th>
                                    <th>Repayment</th>
                                    <th>Outstanding Amount</th>
                                    <th></th>

                                </tr>
                                </tfoot>
                            </table>

                            <?php
                            $sql = "SELECT COUNT(id) FROM Other_Loans";
                            $rs_result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_row($rs_result);
                            $total_records = $row[0];
                            $total_pages = ceil($total_records / $limit);
                            $pagLink = "<nav><ul class='pagination'>";
                            for ($i=1; $i<=$total_pages; $i++) {
                                $pagLink .= "<li><a href='final.php?page=".$i."'>".$i."</a> </li>";
                            };
                            echo $pagLink . "</ul></nav>";
                            ?>
                    </div>
                    <div class="container">
                        <a data-toggle="modal" href="#loans" class="btn btn-success fa fa-plus-circle"></a>
                    </div>


                    <div class="form-panel" style="font-family: San Francisco">
                            <h5 id="label">SECURITY DETAILS </h5>
                            <?php

                            $limit = 3;
                            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                            $start_from = ($page-1) * $limit;

                            $sql = "SELECT * FROM Security WHERE  Security_usermail = '$username' ORDER BY id ASC LIMIT $start_from, $limit";
                            $rs_result = mysqli_query($con, $sql);
                            ?>
                            <table class="table table-striped table-responsive" id="test">
                                <thead class="alert-info">
                                <tr>
                                    <th>Id</th>
                                    <th>Security Type</th>
                                    <th>Security Value</th>
                                    <th>Security Details</th>
                                    <th><i class="glyphicon glyphicon-info-sign alert-danger"></i></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($rs_result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row["Id"]; ?></td>
                                        <td><?php echo $row["Security_type"]; ?></td>
                                        <td><?php echo $row["Security_value"]; ?></td>
                                        <td><?php echo $row["Security_details"]; ?></td>
                                        <td><a href="del.php?sec='<?php echo $row["Id"]; ?>' " class="glyphicon glyphicon-remove"></a></td>
                                    </tr>
                                    <?php
                                };
                                ?>
                                </tbody>
                                <tfoot class="alert-info">
                                <tr>
                                    <th>Id</th>
                                    <th>Security Type</th>
                                    <th>Security Value</th>
                                    <th>Security Details</th>
                                    <th></th>

                                </tr>
                                </tfoot>
                            </table>

                            <?php
                            $sql = "SELECT COUNT(id) FROM Other_Loans";
                            $rs_result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_row($rs_result);
                            $total_records = $row[0];
                            $total_pages = ceil($total_records / $limit);
                            $pagLink = "<nav><ul class='pagination'>";
                            for ($i=1; $i<=$total_pages; $i++) {
                                $pagLink .= "<li><a href='final.php?page=".$i."'>".$i."</a></li>";
                            };
                            echo $pagLink . "</ul></nav>";
                            ?>
                    </div>
                    <div class="container">
                        <a data-toggle="modal" href="#security" class="btn btn-success fa fa-plus-circle"></a>
                    </div>

                    <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="loans" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Loans In Other Institutions</h4>
                                </div>

                                <form class="form-horizontal" method="post" action="add_loans.php">
                                    <div class="modal-body">
                                        <div class="form-group" id="b_name">
                                            <label class="col-sm-2 col-sm-2 control-label">Institution:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="Institution[]" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group" id="b_name">
                                            <label class="col-sm-2 col-sm-2 control-label">Loan Amount:</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="Loan_amount" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group" id="b_nature">
                                            <label class="col-sm-2 col-sm-2 control-label">Date Advanced:</label>
                                            <div class="col-sm-10">
                                                <input type="datetime-local" class="form-control" name="Date_advanced" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group" id="b_nature">
                                            <label class="col-sm-2 col-sm-2 control-label">Repayment Period (Days):</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="Repayment_period" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group" id="b_nature">
                                            <label class="col-sm-2 col-sm-2 control-label">Outstanding Amount:</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="Outstanding_amount" placeholder="" required>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="other_loan">Save changes</button>
                                        </div>

                                    </div>
                                 </form>

                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                    <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="security" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Security</h4>
                                </div>
                                <form class="form-horizontal" method="post" action="add_sec.php" enctype="multipart/form-data">

                                <div class="modal-body">
                                        <div class="form-group" id="b_name">
                                            <label class="col-sm-2 col-sm-2 control-label">Security Type:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="Security_type" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group" id="b_name">
                                            <label class="col-sm-2 col-sm-2 control-label">Estimated Value:</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="Security_value" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group" id="address1">
                                            <label class="col-sm-2 col-sm-2 control-label">Upload a Copy (jpg/png):</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="Security_upload" accept="image/*" required>
                                                <span class="help-block">Upload the copy of security</span>
                                            </div>
                                        </div>

                                        <div class="form-group" id="b_nature">
                                            <label class="col-sm-2 col-sm-2 control-label">Security Details:</label>
                                            <div class="col-sm-10">
                                                <textarea rows="6" title="Add Relevant details" class="form-control" name="Security_details" placeholder="" required> </textarea>
                                            </div>
                                        </div>


                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" name="other_sec" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                    <div class="form-panel">
                        <ol type="1">
                            <h4 class="title">Terms and Conditions</h4>
                            <li>
                            <strong>General</strong>
                            </li>
                            I declare that the information I have provided as part of this application conforms to reality and I assume full responsibility of its accuracy. By my signature, I authorize collection of references from any source whatsoever concerning my person, conduct and commercial credit. I further authorize the issuance of credit reports regarding my credit history of Ned Capital Limited and hereby absolve the reporting party of all responsibility.

                        </ol>

                    </div>
                    <div class="container">
                        <a href="preview.php" class="btn btn-success fa fa-check">Agree and Complete</a>
                    </div>
                </div>
                <!-- /col-lg-9 END SECTION MIDDLE -->


                <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->

                <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                    <h3>LOAN CALCULATOR</h3>

                    <!-- First Action -->
                    <div class="desc">

                        <p class="has-success">
                            <input type="text" class="input-sm form-control" id="amount" name="amount" placeholder="Loan Amount">
                        </p>
                        <p class="has-success">
                            <input type="text" id="months" class="input-sm form-control bg-danger" placeholder="Months">
                        </p>
                        <p class="has-success">
                            <input type="text" id="years" class="input-sm form-control" placeholder="Years">
                        </p>
                        <p class="has-success">
                            <input type="text" id="interest" class="input-sm form-control " placeholder="Interest Rate">
                        </p>
                        <p class="has-success">
                            <input type="text" id="down" class="input-sm form-control" placeholder="Down Payment">
                        </p>
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

<!-- DATA TABLE JS -->
<script src="../custom/dist/jquery.simplePagination.js"></script>


<script type="text/javascript">
    $(document).ready(function(){

        $('.pagination').pagination({
            items: <?php echo $total_records;?>,
            itemsOnPage: <?php echo $limit;?>,
            //cssStyle: 'light-theme',
            cssStyle: '',
            currentPage : <?php echo $page;?>,
            hrefTextPrefix : 'final.php?page='
        });
    });
</script>

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
            monInt = annInterest / 1200,
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

</body>
</html>
