<?php

//Start our session.
session_start();

if (isset($_SESSION['logname']) && ($_SESSION['rank'])) {
    switch($_SESSION['rank']) {

        case 2:
            header('location:../user/index.php');//redirect to  page
            break;
        case 3:
            header('location:../credits/index.php');//redirect to  page
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
//$username=$_SESSION['logname'];
//

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


$code=$_GET['print'];

$result1 = mysqli_query($con, "SELECT * FROM Loan WHERE Loan_code=$code");

while($res = mysqli_fetch_array($result1))
{
    $username= $res['Loan_useremail'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NEDS CAPITAL LIMITED</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../custom/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../custom/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../custom/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Start Styles. Move the 'style' tags and everything between them to between the 'head' tags -->


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="modal-content">
    <!-- Main content -->
    <section class="form-panel">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <!---FOR APPLICATION -->
                <?php
                $code=$_GET['print'];

                $sql = "SELECT * FROM Loan WHERE Loan_code= $code";
                $rs_result = mysqli_query($con, $sql);
                ?>
                <?php
                while ($row = mysqli_fetch_assoc($rs_result)) {
                ?>
                <!---FOR APPLICATION -->
                <h2 class="page-header">
                    <img style='width: 90%' src='../logo-head/logo-head.png'>
                </h2>
                <h2 class="page-header">
                    <h4>LOAN APPLICATION FORM</h4>
                    <small class="pull-right">Application Date: <?php echo $row["Loan_appl_time"]; ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    <h4>Loan Application Type: <?php echo $row["Loan_type"]; ?></h4><br>
                </address>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <h4>SECTION A : PERSONAL INFORMATION</h4>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- FOR PERSONAL DETAILS -->
        <?php
        $sql = "SELECT * FROM Login_Table WHERE Login_Username = '$username'";
        $rs_result = mysqli_query($con, $sql);
        ?>
        <?php
        while ($row3 = mysqli_fetch_assoc($rs_result)) {
            ?>
            <!-- END FOR PERSONAL DETAILS -->
            <div class="row">
                <div class="col-xs-12">
                    <h4>Applicant Full Name (Mr /Mrs/Ms): <?php echo $row3["Firstname"],'&nbsp;', $row3["Middlename"],'&nbsp;',$row3["Sirname"];?></h4>
                </div>
            </div>
            <div style="font-family: 'San Francisco',Arial,sans-serif">
                <div class="row">
                    <!-- TWITTER PANEL -->
                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <h4>Surname: <?php echo $row3["Sirname"]; ?></h4>
                    </div><!-- /col-md-4 -->

                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <!-- WHITE PANEL - TOP USER -->
                        <h4>First Name: <?php echo $row3["Firstname"]; ?></h4>
                    </div><!-- /col-md-4 -->

                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <!-- INSTAGRAM PANEL -->
                        <h4>Middle Name: <?php echo $row3["Middlename"]; ?></h4>
                    </div><!-- /col-md-4 -->

                </div> <!--/END 1ST ROW OF PANELS -->

                <div class="row">
                    <div class="col-xs-12">
                        <h4>National ID No: <?php echo $row3["Login_Id"]; ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Marital Status: <?php echo $row3["Mstatus"]; ?></h4>
                    </div>
                </div>
                <div class="row">
                    <!-- TWITTER PANEL -->
                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <h4>Date of Birth: <?php echo $row3["DOB"]; ?></h4>
                    </div><!-- /col-md-4 -->

                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <!-- WHITE PANEL - TOP USER -->
                        <h4>Sex: <?php echo $row3["Gender"]; ?></h4>
                    </div><!-- /col-md-4 -->

                </div> <!--/END 1ST ROW OF PANELS -->
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Mobile No: <?php echo $row3["Mobile_num"]; ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Postal Address (Current): <?php echo $row3["Address"]; ?></h4>
                    </div>
                </div>
                <div class="row">
                    <!-- TWITTER PANEL -->
                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <h4>Permanent Address: <?php echo $row3["Address"]; ?></h4>
                    </div><!-- /col-md-4 -->

                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <!-- WHITE PANEL - TOP USER -->
                        <h4>Email: <?php echo $row3["Login_Username"]; ?></h4>
                    </div><!-- /col-md-4 -->
                </div> <!--/END 1ST ROW OF PANELS -->
                <div class="row">
                    <!-- TWITTER PANEL -->
                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <h4>Residence(Town): <?php echo $row3["Residence"]; ?></h4>
                    </div><!-- /col-md-4 -->

                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <!-- WHITE PANEL - TOP USER -->
                        <h4>Estate: <?php echo $row3["Estate"]; ?></h4>
                    </div><!-- /col-md-4 -->
                </div> <!--/END 1ST ROW OF PANELS -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <h4>House No: <?php echo $row3["Housenum"]; ?></h4>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 mb">
                        <h4>House Status: <?php echo $row3["House_status"]; ?></h4>
                    </div>
                </div>
            </div>

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <h4>SECTION B : BUSINESS DETAILS</h4>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <div style="font-family: 'San Francisco',Arial,sans-serif">
            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <h4>Name of Business: <?php echo $row["Loan_bus_name"]; ?></h4>
                </div><!-- /col-md-4 -->

                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <h4>Nature of Business: <?php echo $row["Loan_bus_natu"]; ?></h4>
                </div><!-- /col-md-4 -->
            </div> <!--/END 1ST ROW OF PANELS -->
            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <h4>Town: <?php echo $row["Loan_bus_town"]; ?></h4>
                </div><!-- /col-md-4 -->

                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <h4>Building: <?php echo $row["Loan_bus_building"]; ?></h4>
                </div><!-- /col-md-4 -->
            </div> <!--/END 1ST ROW OF PANELS -->
            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <h4>Street: <?php echo $row["Loan_bus_street"]; ?></h4>
                </div><!-- /col-md-4 -->

                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <h4>No of Yrs in this Business: <?php echo $row["Loan_bus_yrs"]; ?></h4>
                </div><!-- /col-md-4 -->
            </div> <!--/END 1ST ROW OF PANELS -->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <h4>SECTION C : LOAN PARTICULARS</h4>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <div style="font-family: 'San Francisco',Arial,sans-serif">
            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <h4>Amount Applied for (Kes): <?php echo $row["Loan_amount"]; ?></h4>
                </div><!-- /col-md-4 -->
            </div> <!--/END 1ST ROW OF PANELS -->
            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <h4>In Words: <?php echo $row["Loan_amount_words"]; ?></h4>
                </div><!-- /col-md-4 -->

                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <h4>Purpose: <?php echo $row["Loan_purpose"]; ?></h4>
                </div><!-- /col-md-4 -->
            </div> <!--/END 1ST ROW OF PANELS -->
            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <h4>Tenure/Period: <?php echo $row["Loan_tenure"]; ?> &nbsp; days.</h4>
                </div><!-- /col-md-4 -->

                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <h4>Monthly Repayments (Kes): <?php echo $row["Loan_repayments"]; ?></h4>
                </div><!-- /col-md-4 -->
            </div> <!--/END 1ST ROW OF PANELS -->
        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <h4>LOANS IN OTHER FINANCIAL INSTITUTIONS</h4>
                <table class="table table-striped table-responsive" border="1">
                    <?php
                    $sql = "SELECT * FROM Other_Loans WHERE User_email = '$username' ORDER BY id";
                    $rs_result = mysqli_query($con, $sql);
                    ?>

                    <thead class="alert-info">
                    <tr>
                        <th>Institution</th>
                        <th>Amount</th>
                        <th>Date Advanced</th>
                        <th>Repayment</th>
                        <th>Outstanding Amount</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row2 = mysqli_fetch_assoc($rs_result)) {
                        ?>
                        <tr>
                            <td><?php echo $row2["Institution"]; ?></td>
                            <td><?php echo $row2["Loan_amount"]; ?></td>
                            <td><?php echo $row2["Date_advanced"]; ?></td>
                            <td><?php echo $row2["Repayment_period"]; ?></td>
                            <td><?php echo $row2["Outstanding_amount"]; ?></td>
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

                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <small><strong class="text-danger">Note*</strong> Business Applicants Only.</small>
        <div class="row">
            <!-- TWITTER PANEL -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <h4>Cost of project (Kes): <?php echo $row["Loan_project_cost"]; ?></h4>
            </div><!-- /col-md-4 -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <h4>Own Contribution (Kes): <?php echo $row["Loan_project_contrib"]; ?></h4>
            </div><!-- /col-md-4 -->
        </div> <!--/END 1ST ROW OF PANELS -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <h4>SECURITY DETAILS</h4>
                <table class="table table-striped table-responsive" id="test" border="1">
                    <?php
                    $sql = "SELECT * FROM Security WHERE  Security_usermail = '$username' ORDER BY id";
                    $rs_result = mysqli_query($con, $sql);
                    ?>
                    <thead class="alert-info">
                    <tr>
                        <th>Id</th>
                        <th>Security Type</th>
                        <th>Security Value</th>
                        <th>Security Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row1 = mysqli_fetch_assoc($rs_result)) {
                        ?>
                        <tr>
                            <td><?php echo $row1["Id"]; ?></td>
                            <td><?php echo $row1["Security_type"]; ?></td>
                            <td><?php echo $row1["Security_value"]; ?></td>
                            <td><?php echo $row1["Security_details"]; ?></td>
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
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.col -->
        </div>

        <h4>GUARANTOR DETAILS</h4>
        <div class="row">
            <!-- TWITTER PANEL -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <h4>Full Name Of Guarantor: <?php echo $row["Loan_guarantor_name"]; ?></h4>
            </div><!-- /col-md-4 -->
        </div> <!--/END 1ST ROW OF PANELS -->
        <div class="row">
            <!-- TWITTER PANEL -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <h4>ID No: <?php echo $row["Loan_guarantor_id"]; ?></h4>
            </div><!-- /col-md-4 -->

            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <!-- WHITE PANEL - TOP USER -->
                <h4>Tel No: <?php echo $row["Loan_guarantor_mobile"]; ?></h4>
            </div><!-- /col-md-4 -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <!-- WHITE PANEL - TOP USER -->
                <h4>E-mail: <?php echo $row["Loan_guarantor_email"]; ?></h4>
            </div><!-- /col-md-4 -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <!-- WHITE PANEL - TOP USER -->
                <h4>Current Residence : <?php echo $row["Loan_guarantor_resd"]; ?></h4>
            </div><!-- /col-md-4 -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <!-- WHITE PANEL - TOP USER -->
                <h4>Residence Status : <?php echo $row["Loan_guarantor_rstat"]; ?></h4>
            </div><!-- /col-md-4 -->
        </div> <!--/END 1ST ROW OF PANELS -->

        <div class="row">
            <!-- TWITTER PANEL -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <h4>Signature :</h4>
            </div><!-- /col-md-4 -->
        </div> <!--/END 1ST ROW OF PANELS -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-8">
                <p class="small">Penalties:</p>
                <p class=" small text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    We shall charge 10% interest per week on the total amount accrued inclusive of the interest due ,if the client fails to
                    pay his/her loan on the agreed date
                </p>
            </div>
        </div>
        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-12">
                <p class="small">Terms and Conditions:</p>
                <p class=" small text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    *Processing fee is at 1.5% of the amount borrowed. (To be recovered upfront upon disbursement)<br>
                    *Monthly interest is at the rate of 20%. (First month to be recovered upfront upon disbursement)<br>
                    * A flat processing fee of Kes 500 will apply to Loans of Kes 30, 000 and below.<br>
                    *Disbursement will be effected upon receipt and confirmation of all the requirements
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <h4>DECLARATION</h4>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <div style="font-family: 'San Francisco',Arial,sans-serif">
            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-lg-12">
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        I declare that the information I have provided as part of this application conforms to reality and I
                        assume full responsibility of its accuracy. By my signature, I authorize collection of references from any
                        source whatsoever concerning my person, conduct and commercial credit. I further authorize the
                        issuance of credit reports regarding my credit history of Ned Capital Limited and hereby absolve the
                        reporting party of all responsibility.
                    </p>
                </div><!-- /col-md-4 -->
            </div> <!--/END 1ST ROW OF PANELS -->
            <div class="row">
                <!-- TWITTER PANEL -->
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <h4>Applicants Name: <?php echo $row3["Firstname"],'&nbsp;', $row3["Middlename"],'&nbsp;',$row3["Sirname"];?></h4>
                </div><!-- /col-md-4 -->

                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <h4>Signature: </h4>
                </div><!-- /col-md-4 -->
                <div class="col-lg-4 col-md-4 col-sm-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <h4>Date: </h4>
                </div><!-- /col-md-4 -->
                <!-- TWITTER PANEL -->

            </div> <!--/END 1ST ROW OF PANELS -->

        </div>
        <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <h4>ATTACHMENTS</h4>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <div style="font-family: 'San Francisco',Arial,sans-serif">

                <div class="row">
                    <div class="col-xs-12">
                        <h4>Applicants National ID/Passport:</h4>
                        <h4><img src='<?php echo $row3["Id_photo"];?>'></h4>
                    </div>
                </div>

            </div>
            <!-- /.row -->

            <!-- PERSONAL DETAILS-->
            <?php
        };
        ?>
        <!-- END OF PERSONAL DETAILS-->

        <!-- CODE -->

        <?php
        };
        ?>
        <!-- END OF CODE -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
<!--</body>-->
</body>
</html>

