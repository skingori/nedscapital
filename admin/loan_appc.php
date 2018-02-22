<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 20/01/2018
 * Time: 15:16
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
$email=$_GET['success'];

include 'header.php';
include 'sidebar.php';
include 'pre_cont.php';
?>


<div class="container" style="font-family: San Francisco"><h4>STEP 3/3: APPLICATION FORM</h4></div>

<div class="form-panel" style="font-family: Consolas">
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ?>

<h5 id="label">LOANS IN OTHER FINANCIAL INSTITUTIONS</h5>

<table class="table table-striped table-responsive table-bordered">
    <thead class="alert-success">
    <tr>
        <th>INSTITUTION</th>
        <th>AMOUNT</th>
        <th>ADVANCED DATE</th>
        <th>REPAYMENT</th>
        <th>OUTSTANDING AMOUNT</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($rs_result)) {
        ?>
        <tr>
            <td><?php echo $row["Institution"]; ?></td>
            <td><?php echo $row["Loan_amount"]; ?></td>
            <td><?php echo $row["Date_advanced"]; ?></td>
            <td><?php echo $row["Repayment_period"]; ?></td>
            <td><?php echo $row["Outstanding_amount"]; ?></td>
        </tr>
        <?php
    };
    ?>
    </tbody>
    <tfoot>
    <tr class="alert-info">
        <th>INSTITUTION</th>
        <th>AMOUNT</th>
        <th>ADVANCED DATE</th>
        <th>REPAYMENT</th>
        <th>OUTSTANDING AMOUNT</th>

    </tr>
    </tfoot>
</table>

<?php
$sql = "SELECT COUNT(id) FROM Other_Loans";
$rs_result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
$pagLink = "<nav><ul class='pagination'>";
for ($i=1; $i<=$total_pages; $i++) {
    $pagLink .= "<li><a href='loan_appb.php?page=".$i."'>".$i."</a> </li>";
};
echo $pagLink . "</ul></nav>";
?>
</div>


<div class="container">
    <a data-toggle="modal" href="#loans" class="btn btn-success fa fa-plus-circle"></a>
</div>


<div class="form-panel" style="font-family: Consolas">
    <h5 id="label">SECURITY DETAILS </h5>

    <table class="table table-striped table-responsive table-bordered" id="test">
        <thead class="alert-warning">
        <tr>
            <th>ID</th>
            <th>SECURITY TYPE</th>
            <th>SECURITY VALUE</th>
            <th>SECURITY DETAILS</th>

        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($rs_result)) {
            ?>
            <tr>
                <td><?php echo $row["Id"]; ?></td>
                <td><?php echo $row["Security_type"]; ?></td>
                <td><?php echo $row["Security_value"]; ?></td>
                <td><?php echo $row["Security_details"]; ?></td>
            </tr>
            <?php
        };
        ?>
        </tbody>
        <tfoot class="alert-info">
        <tr>
            <th>ID</th>
            <th>SECURITY TYPE</th>
            <th>SECURITY VALUE</th>
            <th>SECURITY DETAILS</th>

        </tr>
        </tfoot>
    </table>

    <?php
    $sql = "SELECT COUNT(id) FROM Other_Loans";
    $rs_result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $limit);
    $pagLink = "<nav><ul class='pagination'>";
    for ($i=1; $i<=$total_pages; $i++) {
        $pagLink .= "<li><a href='loan_appb.php?page=".$i."'>".$i."</a></li>";
    };
    echo $pagLink . "</ul></nav>";
    ?>
</div>
<div class="container">
    <a data-toggle="modal" href="#security" class="btn btn-success fa fa-plus-circle"></a>
</div>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="loans" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Loans In Other Institutions</h4>
            </div>

            <form class="form-horizontal" method="post" action="loan_appz.php">
                <div class="modal-body">
                    <div class="form-group" id="" hidden>
                        <label class="col-sm-2 col-sm-2 control-label">User Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="User_email" value="<?php echo $email; ?>" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group" id="b_name">
                        <label class="col-sm-2 col-sm-2 control-label">Institution:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Institution" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group" id="b_name">
                        <label class="col-sm-2 col-sm-2 control-label">Loan Amount:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="Loan_amount" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group" id="b_nature">
                        <label class="col-sm-2 col-sm-2 control-label">Date Advanced:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="Date_advanced" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group" id="b_nature">
                        <label class="col-sm-2 col-sm-2 control-label">Repayment Period (Days):</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="Repayment_period" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group" id="b_nature">
                        <label class="col-sm-2 col-sm-2 control-label">Outstanding Amount (Kes):</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="Outstanding_amount" placeholder="" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="other_loan">Save changes</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
<!-- modal -->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="security" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Security</h4>
            </div>
            <form class="form-horizontal" method="post" action="loan_appx.php" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group" id="b_name">
                        <label class="col-sm-2 col-sm-2 control-label">Security Type:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Security_type" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group" id="b_name">
                        <label class="col-sm-2 col-sm-2 control-label">Estimated Value:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="Security_value" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group" id="address1">
                        <label class="col-sm-2 col-sm-2 control-label">Upload a Copy (jpg/png):</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="Security_upload" accept="image/*" required>
                            <span class="help-block">Upload the copy of security</span>
                        </div>
                    </div>

                    <div class="form-group" id="b_nature">
                        <label class="col-sm-2 col-sm-2 control-label">Security Details:</label>
                        <div class="col-sm-10">
                            <textarea rows="6" title="Add Relevant details" class="form-control" name="Security_details" placeholder="" required> </textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="other_sec" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- modal -->
<div class="form-panel">
    <ol type="1">
        <h4 class="title">Terms and Conditions</h4>
        <li>
            <strong>General</strong>
        </li>
        I declare that the information I have provided as part of this application conforms to reality and I assume full responsibility of its accuracy. By my signature, I authorize collection of references from any source whatsoever concerning my person, conduct and commercial credit. I further authorize the issuance of credit reports regarding my credit history of Ned Capital Limited and hereby absolve the reporting party of all responsibility.

    </ol>

</div>
<div class="container">
    <a href="index.php" class="btn btn-success fa fa-check">Agree and Complete</a>
</div>

    <!-- CONTENT -->

<?php include 'post_cont.php';?>
<?php include 'footer.php';?>

<script type="text/javascript">
    $(document).ready(function(){

        $('.pagination').pagination({
            items: <?php echo $total_records;?>,
            itemsOnPage: <?php echo $limit;?>,
            //cssStyle: 'light-theme',
            cssStyle: '',
            currentPage : <?php echo $page;?>,
            hrefTextPrefix : 'loan_appb.php?page='
        });
    });
</script>
