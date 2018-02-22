<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 20/01/2018
 * Time: 15:01
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

    header('Location:../index.php');
}

include '../connection/db.php';
$username=$_SESSION['logname'];

include 'header.php';
include 'sidebar.php';
include 'pre_cont.php';
?>
<!-- CONTENT -->
    <form class="form-horizontal style-form" method="post" action="process.php" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Loan Type:</label>
        <div class="col-sm-10">
            <select class="form-control" id="loan_type" name="Loan_type" required>
                <option selected></option>
                <option value="Business Loan">Business Loan</option>
                <option value="Personal Loan">Personal Loan</option>
                <option value="LPO Financing">LPO Financing</option>
                <option value="Invoice Discounting">Invoice Discounting</option>
                <option value="Cheque Discounting">Cheque Discounting</option>
                <option value="Contract Financing">Contract Financing</option>
                <option value="Bind Bond Financing">Bind Bond Financing</option>
            </select>
        </div>
    </div>
    <div id="bank">
        <h5 id="label">SECTION B: BUSINESS DETAILS</h5>
        <div class="form-group" id="b_name">
            <label class="col-sm-2 col-sm-2 control-label">Business Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_bus_name" placeholder="The registered name of your business">
            </div>
        </div>
        <div class="form-group" id="b_nature">
            <label class="col-sm-2 col-sm-2 control-label">Business Nature:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_bus_natu" placeholder="Type or general category of business or commerce">
            </div>
        </div>
        <div class="form-group" id="address">
            <label class="col-sm-2 col-sm-2 control-label">Address:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_bus_address" placeholder="365-10954 NAIROBI">
            </div>
        </div>
        <div class="form-group" id="address1">
            <label class="col-sm-2 col-sm-2 control-label">Map:</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="Loan_bus_map" accept="image/*">
                <span class="help-block">Upload the scan of the sketch map</span>
            </div>
        </div>
        <div class="form-group" id="town">
            <label class="col-sm-2 col-sm-2 control-label">Town:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_bus_town" placeholder="The town in which the business resides">
            </div>
        </div>
        <div class="form-group" id="building">
            <label class="col-sm-2 col-sm-2 control-label">Building:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_bus_building" placeholder="Example: JOHN DOE BUILDING">
            </div>
        </div>
        <div class="form-group" id="street">
            <label class="col-sm-2 col-sm-2 control-label">Street:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_bus_street" placeholder="Example: Ronald Ngala street">
            </div>
        </div>
        <div class="form-group" id="business">
            <label class="col-sm-2 col-sm-2 control-label">Yrs in Business:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_bus_yrs" placeholder="Example: 27 Years">
            </div>
        </div>
    </div>

    <div id="loan">
        <h5>SECTION C:LOAN PARTICULARS</h5>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Amount Applied for (Kes):</label>
            <div class="col-sm-10 has-error">
                <input class="form-control" id="Loan_amount" type="number" placeholder="Example: 30000" name="Loan_amount" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Purpose:</label>
            <div class="col-sm-10 has-error">
                <input class="form-control" id="Loan_purpose" type="text" placeholder="Example: To buy a house" name="Loan_purpose" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Tenure/Period (Days)</label>
            <div class="col-sm-10 has-error">
                <input class="form-control" id="Loan_tenure" type="number" placeholder="Example: 30" name="Loan_tenure" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Monthly Repayments (Kes):</label>
            <div class="col-sm-10 has-error">
                <input readonly="" class="form-control" id="Loan_repayments" type="number" name="Loan_repayments" required>
            </div>
        </div>
    </div>
    <div id="other" style="display:none;">
        <h4 id="project">MORE DETAILS</h4>
        <div class="form-group has-warning" id="p_cost" >
            <label class="col-sm-2 col-sm-2 control-label">Cost of Project (Kes):</label>
            <div class="col-sm-10">
                <input class="form-control" id="" type="number" placeholder="" name="Loan_project_cost">
                <span class="help-block">If you want to finance the project</span>
            </div>
        </div>
        <div class="form-group has-warning" id="p_cont">
            <label class="col-sm-2 col-sm-2 control-label">Own Contribution (Kes):</label>
            <div class="col-sm-10">
                <input class="form-control" id="inputSuccess" type="number" placeholder="Amount you've contributed for your project" name="Loan_project_contrib">
            </div>
        </div>
    </div>
    <div id="guarantor">
        <h5>GUARANTOR DETAILS</h5>
        <div class="form-group" id="b_nature">
            <label class="col-sm-2 col-sm-2 control-label">Full Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_guarantor_name" placeholder="Name of the guarantor" required>
            </div>
        </div>
        <div class="form-group" id="b_nature">
            <label class="col-sm-2 col-sm-2 control-label">ID NO:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="Loan_guarantor_id" placeholder="ID NO of the guarantor">
            </div>
        </div>
        <div class="form-group" id="b_nature">
            <label class="col-sm-2 col-sm-2 control-label">Tel NO:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_guarantor_mobile" placeholder="Working contact of the guarantor" required>
            </div>
        </div>
        <div class="form-group" id="b_nature">
            <label class="col-sm-2 col-sm-2 control-label">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="Loan_guarantor_email" placeholder="Example: john.doe@email.com" required>
            </div>
        </div>
        <div class="form-group" id="b_nature">
            <label class="col-sm-2 col-sm-2 control-label">Current Residence:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Loan_guarantor_resd" placeholder="Current residing place of the guarantor" required>
            </div>
        </div>
        <div class="form-group" id="b_nature">
            <label class="col-sm-2 col-sm-2 control-label">Residence Type:</label>
            <div class="col-sm-10">
                <select class="form-control" name="Loan_guarantor_rstat" required>
                    <option selected></option>
                    <option value="Rented">Rented Residence</option>
                    <option value="Personal">Personal Residence</option>
                </select>
            </div>
        </div>

    </div>

    <div class="btn-group-justified centered">
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="get_loan">Confirm Application</button>
            <strong>STEP 2/3</strong>
        </div>
    </div>

    </form>


<!-- CONTENT -->

<?php include 'post_cont.php';?>
<?php include 'footer.php';?>