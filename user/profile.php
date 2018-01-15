<?php

session_start();
// Check, if user is already login, then jump to secured page
if (isset($_SESSION['logname']) && ($_SESSION['rank'])) {
switch($_SESSION['rank']) {

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

$result1 = mysqli_query($con, "SELECT * FROM Login_Table WHERE Login_Username='$username'");

while($res = mysqli_fetch_array($result1))
{
$username= $res['Login_Username'];
$id= $res['Login_Id'];

}


if (isset($_POST['prof'])) {

//$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

//$image_name = addslashes($_FILES['image']["name"]);
//$image_size = getimagesize($_FILES['image']['tmp_name']);

    move_uploaded_file($_FILES["photo"]["tmp_name"], '../upload/' . $_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["id"]["tmp_name"], '../upload/' . $_FILES["id"]["name"]);

    $photo = '../upload/' . $_FILES["photo"]["name"];
    $id_photo = '../upload/' . $_FILES["id"]["name"];

    $Sirname_ = $_POST['Sirname'];
    $Firstname_ = $_POST['Firstname'];
    $Middlename_ = $_POST['Middlename'];
    $Mstatus_ = $_POST['Mstatus'];
    $DOB_ = $_POST['DOB'];
    $Address_ = $_POST['Address'];
    $Housenum_ = $_POST['Housenum'];
    $House_status_ = $_POST['House_status'];
    $Mobile_num_ = $_POST['Mobile_num'];
    $Gender_ = $_POST['Gender'];
    $Residence_ = $_POST['Residence'];
    $Estate_ = $_POST['Estate'];

    $sql = "UPDATE Login_Table SET Sirname='$Sirname_',Firstname='$Firstname_',Middlename='$Middlename_',Mstatus='$Mstatus_',
    DOB='$DOB_',Address='$Address_',Housenum='$Housenum_',House_status='$House_status_',Mobile_num='$Mobile_num_',Gender='$Gender_',
    Residence='$Residence_',Estate='$Estate_',Photo='$photo',Id_photo='$id_photo' WHERE Login_Id=$id";

    if ($con->query($sql) === TRUE) {

        $msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Success!
					</div>";
        echo '<meta content="4;index.php" http-equiv="refresh" >';

    } else {

        $msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-warning-sign'></span> &nbsp; Error!. $con->error
					</div>";
    }

    $con->close();
}
    ?>

<!-- Header -->
<?php include "header.php";?>
<!-- sidebar -->
<?php include "sidebar.php";?>
<!-- Before content -->
<?php include "pre_cont.php";?>
<!-- content-->
<?php
if (isset($msg)) {
    echo $msg;
}
?>
    <form class="form-inline" method="post" style="font-family: San Francisco" enctype="multipart/form-data">
        <h5 style="color: #FF6C60">Personal information </h5>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Sir Name</label>
            <input type="text" class="form-control" id="exampleInputEmail2" name="Sirname" placeholder="Sir Name" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">First Name</label>
            <input type="text" class="form-control" id="exampleInputEmail2" name="Firstname" placeholder="First Name" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Middle Name</label>
            <input type="text" class="form-control" id="exampleInputEmail2" name="Middlename" placeholder="Middle Name" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Marital Status</label>
            <select class="form-control" name="Mstatus">
                <option selected>--Option--</option>
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Mobile Number:</label>
            <input type="text" class="form-control" id="exampleInputEmail2" name="Mobile_num" placeholder="Mobile Number" required>
        </div>
        <br>
        <h5 style="color: #2A3542">More information </h5>
        <div class="form-group">
            <label class="" for="exampleInputEmail2">Date of Birth:</label>
            <input type="date" class="form-control" id="exampleInputEmail2" name="DOB" required>
        </div>
        <div class="form-group">
            <label class="" for="exampleInputEmail2">Gender:</label>
            <select class="form-control" name="Gender">
                <option selected>--Option--</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <h5 style="color: #2A3542">File Uploads</h5>
        <div class="form-group">
            <label class="" for="exampleInputEmail2">Upload ID Scan:</label>
            <input type="file" class="form-control" id="id" name="id" accept="image/*" required>
        </div>
        <div class="form-group">
            <label class="" for="exampleInputEmail2">Upload Passport Size Photo:</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
        </div>
        <br>
        <h5 style="color: #FF6C60">Residence information </h5>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Postal Address</label>
            <input type="text" class="form-control" id="exampleInputEmail2" name="Address"placeholder="Current Postal Address" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2"></label>
            <input type="text" class="form-control" id="exampleInputEmail2" name="Housenum" placeholder="House Number" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="House_status"></label>
            <select class="form-control" name="House_status">
                <option selected>--Option--</option>
                <option value="Rented">House Rented</option>
                <option value="Owned">House Owned</option>
            </select>

        </div>

        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword2">Residence (Town)</label>
            <input type="text" class="form-control" id="exampleInputPassword2" name="Residence" placeholder="Residence (Town)">
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword2">Estate</label>
            <input type="text" class="form-control" id="exampleInputPassword2" name="Estate" placeholder="Estate">
        </div>
        <hr>
        <h5><u>Terms And Conditions</u></h5>
        I declare that the information I have provided as part of this application conforms to reality and I assume full responsibility of its accuracy. By my signature, I authorize collection of references from any source whatsoever concerning my person, conduct and commercial credit. I further authorize the issuance of credit reports regarding my credit history of Ned Capital Limited and hereby absolve the reporting party of all responsibility.
        <br>
        <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox1" title="Agree to the Terms" value="option1" required> Agree to the Terms and Confirm
        </label>
        <hr>
        <p>
            <button type="submit" name="prof" class="btn btn-success">Agree and confirm</button>
        </p>

    </form>

<!-- After content -->
<?php include "post_cont.php";?>
<!-- footer -->
<?php include "footer.php";?>