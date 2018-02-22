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
?>

<?php include 'header.php';?>
<?php include 'sidebar.php';?>
<?php include 'pre_cont.php';?>
<!-- CONTENT -->
<h5>All Applications Available for Approval </h5>
    <table class="table table-striped table-responsive" style="font-family: AppleMyungjo">
        <?php
        $sql = "SELECT * FROM Loan WHERE Loan_Status='Application Sent' ORDER BY Loan_id";
        $rs_result = mysqli_query($con, $sql);
        ?>

        <thead class="alert-info">
        <tr>
            <th>ID</th>
            <th>LOAN CODE</th>
            <th>LOAN TYPE</th>
            <th>GUARANTOR CONTACT</th>
            <th>AMOUNT</th>
            <th>LOAN STATUS</th>
            <th>APPROVE</th>
            <th>DECLINE</th>
            <th>PREVIEW</th>

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
                <td><a href="del.php?approve='<?php echo $row["Loan_code"]; ?>'" class="btn-sm btn-success">Approve</a></td>
                <td><a href="del.php?decline='<?php echo $row["Loan_code"]; ?>'" class="btn-danger btn-sm">Decline</a></td>
                <td><a target="_blank" href="print.php?print='<?php echo $row["Loan_code"]; ?>'" class="btn-info btn-sm">Preview</a></td>

            </tr>
            <?php
        };
        ?>
        </tbody>
        <tfoot>
        <tr class="alert-warning">
            <th>ID</th>
            <th>LOAN CODE</th>
            <th>LOAN TYPE</th>
            <th>GUARANTOR CONTACT</th>
            <th>AMOUNT</th>
            <th>LOAN STATUS</th>
            <th>APPROVE</th>
            <th>DECLINE</th>
            <th>PREVIEW</th>

        </tr>
    </table>

<!-- END OF CONTENT -->
<?php include 'post_cont.php';?>
<?php include 'footer.php';?>