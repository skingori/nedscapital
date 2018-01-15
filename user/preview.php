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
<!-- Header -->
<?php include "header.php";?>
<!-- sidebar -->
<?php include "sidebar.php";?>
<!-- Before content -->
<?php include "pre_cont.php";?>

    <h5>Applications Available for Printing </h5>
    <table class="table table-striped table-responsive" style="font-family: Consolas">
        <?php
        $sql = "SELECT * FROM Loan WHERE Loan_useremail= '$username' AND Loan_Status='Application Sent' ORDER BY Loan_id";
        $rs_result = mysqli_query($con, $sql);
        ?>

        <thead class="alert-info">
        <tr>
            <th>ID</th>
            <th>Loan Code</th>
            <th>Loan Type</th>
            <th>Guarantor Contact</th>
            <th>Amount</th>
            <th>Loan Status</th>
            <th>Print</th>

        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($rs_result)) {
            ?>
            <tr>
                <td><?php echo $row["Loan_id"]; ?></td>
                <td><?php echo $row["Loan_code"]; ?></td>
                <td><?php echo $row["Loan_type"]; ?></td>
                <td><?php echo $row["Loan_guarantor_mobile"]; ?></td>
                <td><?php echo $row["Loan_amount"]; ?></td>
                <td><?php echo $row["Loan_Status"]; ?></td>
                <td><a target="_blank" href="print.php?print='<?php echo $row["Loan_code"]; ?>'" class="glyphicon glyphicon-print"></a></td>

            </tr>
            <?php
        };
        ?>
        </tbody>
        <tfoot>
        <tr class="alert-info">
            <th>ID</th>
            <th>Loan Code</th>
            <th>Loan Type</th>
            <th>Guarantor Contact</th>
            <th>Amount</th>
            <th>Loan Status</th>
            <th>Print</th>

        </tr>
        </tfoot>
    </table>

<?php include "post_cont.php";?>
<?php include "footer.php";?>
