<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 10/01/2018
 * Time: 15:10
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
//
$code = $_GET['disburse'];
$result = mysqli_query($con, "SELECT * FROM Neds_Offer WHERE Offer_Loan_Code= $code");

while($res = mysqli_fetch_array($result))
{
    $Offer_Code_= $res['Offer_Code'];
}
//
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

?>

<?php include "header.php";?>
<?php include "sidebar.php";?>
<?php include "pre_cont.php";?>

    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>

    <form class="form-horizontal style-form" method="post" action="disburse.php">
        <?php
        $sql = "SELECT * FROM Loan WHERE Loan_code = $code";
        $rs_result = mysqli_query($con, $sql);
        ?>
        <?php
        while ($row = mysqli_fetch_assoc($rs_result)) {
            ?>

            <div class="form-group" id="address">
                <label class="col-sm-2 col-sm-2 control-label">Applicants Email:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="<?php echo $row["Loan_useremail"]; ?>" id="" name="Disburse_Usermail" placeholder="">
                </div>
            </div>
            <div class="form-group" id="address" hidden>
                <label class="col-sm-2 col-sm-2 control-label">Offer Code:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="<?php echo $Offer_Code_; ?>" id="" name="Disburse_Offer_Code" placeholder="">
                </div>
            </div>
            <div class="form-group" id="address">
                <label class="col-sm-2 col-sm-2 control-label">Loan Code:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="<?php echo $row["Loan_code"]; ?>" id="" name="Disburse_Loan_Code" placeholder="">
                </div>
            </div>
            <div class="form-group" id="address">
                <label class="col-sm-2 col-sm-2 control-label">Received Amount (Kes):</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="<?php echo $row["Loan_amount"]; ?>" id="Loan_amount" name="Disburse_Amount" placeholder="">
                </div>
            </div>
            <div class="form-group" id="b_name">
                <label class="col-sm-2 col-sm-2 control-label">Amount in Words:</label>
                <div class="col-sm-10">
                    <textarea type="text" readonly name="Disburse_Amountwords" rows="3" class="form-control"><?php echo $row["Loan_amount_words"]; ?></textarea>
                </div>
            </div>
            <div class="form-group" id="b_nature">
                <label class="col-sm-2 col-sm-2 control-label">Interest (Kes):</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" name="Disburse_Interest" id="interest" placeholder="">
                </div>
            </div>
            <div class="form-group" id="b_name">
                <label class="col-sm-2 col-sm-2 control-label">Amount to Pay (Kes):</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" id="Loan_repayments" value="<?php echo $row["Loan_repayments"]; ?>" name="Disburse_Total" placeholder="">
                </div>
            </div>
            <div class="form-group" id="address1">
                <label class="col-sm-2 col-sm-2 control-label">Initialization Date:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="txtDate" name="initialdate" placeholder="" required>
                </div>
            </div>
            <div class="form-group centered">
                <button class="fa fa-envelope btn btn-primary" name="disburse"> Disburse Loan</button>
            </div>
            <?php
        }
        ?>
    </form>

<?php include "post_cont.php";?>


<?php include "footer.php";?>

<script>
    $(document).ready(function(){
        var total = $('#Loan_amount').val();
        var pay = $('#Loan_repayments').val();
        $('#interest').val(pay-total);
    });
</script>

<script>//Disable date
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#txtDate').attr('min', maxDate);
    });
</script>