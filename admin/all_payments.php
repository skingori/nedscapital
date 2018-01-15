<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 15/01/2018
 * Time: 16:24
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

?>

<?php include 'header.php';?>
<?php include 'sidebar.php';?>
<?php include 'pre_cont.php';?>
    <!-- CONTENT -->
    <h5>Ned Capital : Available Payments</h5>
    <table cellpadding="1" cellspacing="1" id="payments" class="table table-responsive table-striped" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>PAY CODE</th>
            <th>USER MAIL</th>
            <th>AMOUNT PAID</th>
            <th>PAYMENT MODE</th>
            <th>PAYMENT REF</th>
            <th>PAYMENT DATE</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>PAY CODE</th>
            <th>USER MAIL</th>
            <th>AMOUNT PAID</th>
            <th>PAYMENT MODE</th>
            <th>PAYMENT REF</th>
            <th>PAYMENT DATE</th>
        </tr>
        </tfoot>
    </table>
    <!-- END OF CONTENT -->
<?php include 'post_cont.php';?>
<?php include 'footer.php';?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#payments').DataTable({
            "columns": [
                {"data": "Id"},
                {"data": "Pay_Code"},
                {"data": "Pay_Usermail"},
                {"data": "Pay_Amount"},
                {"data": "Pay_Mode"},
                {"data": "Pay_Ref"},
                {"data": "Pay_Date"}
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: 'account/acc_pay.php',
                type: 'POST'
            }
        });
    });
</script>

