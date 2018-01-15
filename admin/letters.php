<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 15/01/2018
 * Time: 12:20
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
?>

<?php include 'header.php';?>
<?php include 'sidebar.php';?>
<?php include 'pre_cont.php';?>
    <!-- CONTENT -->
    <h5>Active offer letters</h5>
    <table class="table table-striped table-responsive" style="font-family: AppleMyungjo">
        <?php
        $sql = "SELECT * FROM Neds_Offer WHERE Offer_Repayment_Status !='Paid' ORDER BY Id";
        $rs_result = mysqli_query($con, $sql);
        ?>

        <thead class="alert-info">
        <tr>
            <th>ID</th>
            <th>Applicant Mail</th>
            <th>Offer Code</th>
            <th>Loan Code</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Resend</th>

        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($rs_result)) {
            ?>
            <tr>
                <td><?php echo $row["Id"]; ?></td>
                <td><?php echo $row["Offer_Usermail"]; ?></td>
                <td><?php echo $row["Offer_Code"]; ?></td>
                <td><?php echo $row["Offer_Loan_Code"]; ?></td>
                <td><?php echo $row["Offer_Total"]; ?></td>
                <td><?php echo $row["Offer_Payment_Date"]; ?></td>
                <td><a href="" class="btn-success btn-sm">Send</a></td>

            </tr>
            <?php
        };
        ?>
        </tbody>
        <tfoot>
        <tr class="alert-warning">
            <th>ID</th>
            <th>Applicant Mail</th>
            <th>Offer Code</th>
            <th>Loan Code</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Resend</th>

        </tr>
    </table>

    <!-- END OF CONTENT -->
<?php include 'post_cont.php';?>
<?php include 'footer.php';?>