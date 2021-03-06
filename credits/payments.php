<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 15/01/2018
 * Time: 12:37
 */

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
    <strong class='glyphicon glyphicon-info-sign'></strong>&nbsp;Success,payment done!.
    </div>";
}elseif (isset($_GET['error'])){

    $msg = "<div class='text-danger'>
    <strong class='glyphicon glyphicon-info-sign'></strong>&nbsp;Sorry ,error in payment.
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
    <h5>Capitalquest CBS: Active offers</h5>
    <table class="table table-striped table-condensed" style="font-family: AppleMyungjo">
        <?php
        //$sql = "SELECT * FROM Neds_Offer WHERE Offer_Repayment_Status !='Paid' AND DATE(Offer_Payment_Date) >= DATE(NOW())";
        $sql = "SELECT * FROM Neds_Disburse WHERE Disburse_Repayment_Status !='Paid'";
        $rs_result = mysqli_query($con, $sql);
        ?>

        <thead class="alert-info">
        <tr>
            <th>ID</th>
            <th>MAIL</th>
            <th>OFFER CODE</th>
            <th>LOAN CODE</th>
            <th>AMOUNT</th>
            <th>DUE DATE</th>
            <th>PAYMENT</th>
            <th>PROVISION</th>

        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($rs_result)) {
            ?>
            <tr>
                <td><?php echo $row["Id"]; ?></td>
                <td><?php echo $row["Disburse_Usermail"]; ?></td>
                <td><?php echo $row["Disburse_Code"]; ?></td>
                <td><?php echo $row["Disburse_Loan_Code"]; ?></td>
                <td><?php echo $row["Disburse_Total"]; ?></td>
                <td><?php echo $row["Disburse_Payment_Date"]; ?></td>
                <td><a href="makepay.php?code='<?php echo $row["Disburse_Loan_Code"]; ?>'" class="btn-sm btn-primary fa fa-tag">Pay Now</a></td>
                <td><a href="makepay.php?code='<?php echo $row["Disburse_Loan_Code"]; ?>'" class="btn-sm btn-warning fa fa-check">Send Now</a></td>

            </tr>
            <?php
        };
        ?>
        </tbody>
        <tfoot>
        <tr class="alert-warning">
            <th>ID</th>
            <th>MAIL</th>
            <th>OFFER CODE</th>
            <th>LOAN CODE</th>
            <th>AMOUNT</th>
            <th>DUE DATE</th>
            <th>PAYMENT</th>
            <th>PROVISION</th>

        </tr>
    </table>

    <!-- END OF CONTENT -->
<?php include 'post_cont.php';?>
<?php include 'footer.php';?>