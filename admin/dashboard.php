<?php include "header.php";
include "sidebar.php";
include "pre_cont.php";
?>

<!-- ADD CONTENT HERE -->
<h5>This is the Report Board</h5>

<div class="box-body">
    Start here to exercise your privileges

    <ol type="1" class="">
        Loan Reports
        <li><a href="unhandled.php">Active Loans </a> <i class="fa fa-check-circle-o text-success"></i></li>
        <li><a href="all_payments.php">All Payments</a> <i class="fa fa-check-circle-o text-success"></i></li>
    </ol>
    <ol type="1" class="">
        Client Reports
        <!--<li><a href="unhandled.php">Un-handled Cases</a></li>
        <li><a href="handled.php">Handled Cases</a></li>
        <li><a href="officers.php">All Officers</a></li>
        <li><a href="handled.php">All Users</a></li>-->
        <li><a href="unhandled.php">Active Loans </a> <i class="fa fa-check-circle-o text-success"></i></li>
        <li><a href="handled.php">All Payments</a> <i class="fa fa-check-circle-o text-success"></i></li>
    </ol>
    <ol type="1" class="">
        Provision Report
        <!--<li><a href="unhandled.php">Un-handled Cases</a></li>
        <li><a href="handled.php">Handled Cases</a></li>
        <li><a href="officers.php">All Officers</a></li>
        <li><a href="handled.php">All Users</a></li>-->
        <li><a href="unhandled.php">Active Loans </a> <i class="fa fa-check-circle-o text-success"></i></li>
        <li><a href="handled.php">All Payments</a> <i class="fa fa-check-circle-o text-success"></i></li>
    </ol>
    <ol type="1">
        New entry
        <!--<li><a href="off_new.php">New Officer</a> <i class="fa fa-plus-circle text-info"></i></li>-->

    </ol>

    <?php

    $result = mysqli_query($con,"SELECT COUNT(Missing_Persons_Id) FROM Missing_Persons_Table");
    $row1 = mysqli_fetch_array($result);

    $x = $row1[0];
    //
    $result = mysqli_query($con,"SELECT COUNT(Handling_Officer_Id) FROM Handling_Officer_Table WHERE Handling_Officer_Officer_Id='$id'");
    $row2 = mysqli_fetch_array($result);

    $xx = $row2[0];
    ?>

</div>
<!--<ul class="sub">
    <li><a  href="all_payments.php">Payments</a></li>
    <li><a  href="all_paidloan.php">Paid Loans</a></li>
    <li><a  href="all_actiloan.php">Active Loans</a></li>
    <li><a  href="all_default.php">Defaulters</a></li>
</ul>

<!-- END ADD CONTENT HERE -->

<?php include "post_cont.php";
include "footer.php";?>
