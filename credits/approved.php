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
$username=$_SESSION['logname'];
//
//Send message//
if (isset($_GET['success'])){

    $msg = "<div class='text-info'>
    <strong class='glyphicon glyphicon-info-sign'></strong>&nbsp;Congratulations,Offer letter Sent.
    </div>";
}elseif (isset($_GET['error'])){

    $msg = "<div class='text-danger'>
    <strong class='glyphicon glyphicon-info-sign'></strong>&nbsp;Sorry ,double sending not allowed.
    </div>";
}
?>

<?php include 'header.php';?>
<?php include 'sidebar.php';?>
<?php include 'pre_cont.php';?>
    <!-- CONTENT -->
<?php
if (isset($msg)) {
    echo $msg;
}
?>
    <h5>All approved applications</h5>
    <table class="table table-striped table-responsive" style="font-family: AppleMyungjo">
        <?php
        $sql = "SELECT * FROM Loan WHERE Loan_Status='Approved' AND Loan_code NOT IN(SELECT Offer_Loan_Code FROM Neds_Offer) ORDER BY Loan_id";
        $rs_result = mysqli_query($con, $sql);
        ?>

        <thead class="alert-info">
        <tr>
            <th>LOAN CODE</th>
            <th width="15%">LOAN TYPE</th>
            <th>EMAIL</th>
            <th>AMOUNT</th>
            <th width="15%">APPLIED ON</th>
            <th width="15%">APPROVED ON</th>
            <th>FINISH</th>
            <th>PREVIEW</th>
            <th>TRASH</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($rs_result)) {
            ?>
            <tr>
                <td><?php echo $row["Loan_code"]; ?></td>
                <td><?php echo $row["Loan_type"]; ?></td>
                <td><?php echo $row["Loan_useremail"]; ?></td>
                <td><?php echo $row["Loan_amount"]; ?></td>
                <td><?php echo $row["Loan_appl_time"]; ?></td>
                <td><?php echo $row["Loan_appr_time"]; ?></td>
                <td><a href="offer.php?approve='<?php echo $row["Loan_code"]; ?>'" class="fa fa-envelope-o"> Fin</a></td>
                <td><a target="_blank" href="print.php?print='<?php echo $row["Loan_code"]; ?>'" class="fa fa-search"> View</a></td>
                <td><a href="del.php?apptrash='<?php echo $row["Loan_id"]; ?>'" class="fa fa-trash-o text-danger"> Del</a></td>

            </tr>
            <?php
        };
        ?>
        </tbody>
        <tfoot>
        <tr class="alert-warning">
            <th>LOAN CODE</th>
            <th width="15%">LOAN TYPE</th>
            <th>EMAIL</th>
            <th>AMOUNT</th>
            <th width="15%">APPLIED ON</th>
            <th width="15%">APPROVED ON</th>
            <th>FINISH</th>
            <th>PREVIEW</th>
            <th>TRASH</th>


        </tr>
    </table>

    <!-- END OF CONTENT -->
<?php include 'post_cont.php';?>
<?php include 'footer.php';?>