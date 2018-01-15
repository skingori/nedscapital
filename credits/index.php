<?php

//Start our session.
session_start();

if (isset($_SESSION['logname']) && ($_SESSION['rank'])) {
    switch($_SESSION['rank']) {

        case 2:
            header('location:../user/index.php');//redirect to  page
            break;
        case 1:
            header('location:../admin/index.php');//redirect to  page
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
<h5>All Applications Available for Approval </h5>
    <table class="table table-striped table-responsive table-bordered" style="font-family: AppleMyungjo">
        <?php
        $sql = "SELECT * FROM Loan WHERE Loan_Status='Application Sent' ORDER BY Loan_id";
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
            <th>Send to admin</th>
            <th>Decline</th>

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
                <td><a href="cred.php?approve='<?php echo $row["Loan_code"]; ?>'" class="btn-sm btn-success">Send approval</a></td>
                <td><a href="cred.php?decline='<?php echo $row["Loan_code"]; ?>'" class="btn-danger btn-sm">Decline</a></td>

            </tr>
            <?php
        };
        ?>
        </tbody>
        <tfoot>
        <tr class="alert-warning">
            <th>ID</th>
            <th>Loan Code</th>
            <th>Loan Type</th>
            <th>Guarantor Contact</th>
            <th>Amount</th>
            <th>Loan Status</th>
            <th>Send to admin</th>
            <th>Decline</th>

        </tr>
    </table>

<!-- END OF CONTENT -->
<?php include 'post_cont.php';?>
<?php include 'footer.php';?>