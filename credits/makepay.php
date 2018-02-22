<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 15/01/2018
 * Time: 13:08
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

    <form class="form-horizontal style-form" method="post" action="payoff.php">
        <?php
        $code = $_GET['code'];

        $sql = "SELECT * FROM Neds_Offer WHERE  Offer_Loan_Code= $code";
        $rs_result = mysqli_query($con, $sql);
        ?>
        <?php
        while ($row = mysqli_fetch_assoc($rs_result)) {
            ?>

            <div class="form-group" id="address" hidden>
                <label class="col-sm-2 col-sm-2 control-label">Loan Code:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="<?php echo $row["Offer_Loan_Code"]; ?>" id="" name="Pay_Loan_Code" placeholder="">
                </div>
            </div>
            <div class="form-group" id="address" hidden>
                <label class="col-sm-2 col-sm-2 control-label">Offer Code:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="<?php echo $row["Offer_Code"]; ?>" id="" name="Pay_Offer_Code" placeholder="">
                </div>
            </div>
            <div class="form-group" id="address" hidden>
                <label class="col-sm-2 col-sm-2 control-label">Applicant Mail:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" value="<?php echo $row["Offer_Usermail"]; ?>" id="" name="Pay_Usermail" placeholder="">
                </div>
            </div>
            <div class="form-group" id="address">
                <label class="col-sm-2 col-sm-2 control-label">Amount to Pay (Kes):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="" id="Loan_amount" name="Pay_Amount" placeholder="" required>
                </div>
            </div>
            <div class="form-group" id="address">
                <label class="col-sm-2 col-sm-2 control-label">Payment Mode:</label>
                <div class="col-sm-10">
                    <select type="text" class="form-control" name="Pay_Mode">
                        <option value="M-PESA">M-PESA</option>
                        <option value="BANK">BANK</option>
                        <option value="AIRTEL MONEY">AIRTEL MONEY</option>
                        <option value="OTHER">OTHER</option>
                    </select>
                </div>
            </div>
            <div class="form-group" id="address">
                <label class="col-sm-2 col-sm-2 control-label">Payment Ref:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="Pay_Ref" placeholder="Example: BZ5OIBGYNLO" required>
                </div>
            </div>
            <div class="form-group" id="b_name">
                <label class="col-sm-2 col-sm-2 control-label">Description:</label>
                <div class="col-sm-10">
                    <textarea type="text" name="Pay_Desc" rows="10" class="form-control" required></textarea>
                </div>
            </div>

            <div class="form-group centered">
                <button class="fa fa-check btn btn-success" name="payoff"> Confirm Payment</button>
            </div>
            <?php
        }
        ?>
    </form>

<?php include "post_cont.php";?>


<?php include "footer.php";?>
