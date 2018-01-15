<?php
require('connection/db.php');

if(isset($_POST['reg'])) {


    $Login_Id_= strip_tags($_POST['Login_Id']);
    $Login_Username_= strip_tags($_POST['Login_Username']);
    $Login_Password_= strip_tags($_POST['Login_Password']);
    //$login_rank_= strip_tags($_POST['login_rank']);
//$Login_Username_= strip_tags($_POST['Login_Username']);


    $Login_Id= $con->real_escape_string($Login_Id_ );
    $Login_Username= $con->real_escape_string($Login_Username_ );
    $Login_Password= $con->real_escape_string($Login_Password_);
    //$login_rank= $con->real_escape_string($login_rank_ );
//$Login_Username= $con->real_escape_string($Login_Username_);
    $enc= md5($Login_Password);
//$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version

    $check_ = $con->query("SELECT Login_Username FROM Login_Table WHERE Login_Username='$Login_Username'");
    $count=$check_->num_rows;

    if ($count==0) {

        $query = "INSERT INTO Login_Table(Login_Id,Login_Username,Login_Password,Login_Rank) VALUES('$Login_Id','$Login_Username','$enc','2')";

//inserting in login table
//$query .= "INSERT INTO Login_table(Login_Username,login_rank,Login_Password,login_status) VALUES('$uname','$rank','$enc','Inactive')";

        if ($con->query($query)) {
            $msg = "<div class='alert alert-success'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
</div>";
            ?>

            <p align="center">
                <meta content="2;index.php?login" http-equiv="refresh" />
            </p>

            <?php

        }else {
            $msg = "<div class='alert alert-warning'>
    <span class='glyphicon glyphicon-warning-sign'></span> &nbsp; error while registering !
</div>";
        }

    } else {


        $msg = "<div class='alert alert-danger'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry username already taken !
</div>";

    }

    $con->close($con);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Ned Capital | Register</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
		      <form class="form-login" method="post">

		        <h2 class="form-login-heading">sign up now</h2>
		        <div class="login-wrap">
                    <?php
                    if (isset($msg)) {
                        echo $msg;
                    }
                    ?>
		            <input type="text" class="form-control" name="Login_Id" placeholder="ID or Passport number" title="Must contain only numbers 0-15" minlength="4" maxlength="15" pattern="\d*" autofocus required>
		            <br>
                    <input type="email" class="form-control" id="txtmail" name="Login_Username" placeholder="Your Email" required onclick='Javascript:checkEmail();'>
                    <br>
                    <input type="password" class="form-control" name="Login_Password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" id="txtpassword" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." onkeyup="CheckPasswordStrength(this.value)">
                    <span id="password_strength" class="centered"></span>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" required> I agree to the <a data-toggle="modal" href="#myModal">terms</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-theme btn-block" type="submit" name="reg"><i class="fa fa-unlock"></i> CREATE ACCOUNT</button>
		            <hr>

		            <div class="registration">
		                You have an account already?<br/>
		                <a class="" href="index.php">
		                    Login Here
		                </a>
		            </div>
		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Terms and Conditions</h4>
		                      </div>
		                      <div class="modal-body">
                                  <ol type="1">
                                      <li>
                                          I declare that the information I have provided as part of this application conforms to reality and I assume full responsibility of its accuracy. By my signature, I authorize collection of references from any source whatsoever concerning my person, conduct and commercial credit. I further authorize the issuance of credit reports regarding my credit history of Ned Capital Limited and hereby absolve the reporting party of all responsibility.
                                      </li>
                                  </ol>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Accept</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/balance-865091_1920.jpg", {speed: 500});
    </script>
      <script type="text/javascript">
          function CheckPasswordStrength(password) {
              var password_strength = document.getElementById("password_strength");

              //TextBox left blank.
              if (password.length == 0) {
                  password_strength.innerHTML = "";
                  return;
              }

              //Regular Expressions.
              var regex = new Array();
              regex.push("[A-Z]"); //Uppercase Alphabet.
              regex.push("[a-z]"); //Lowercase Alphabet.
              regex.push("[0-9]"); //Digit.
              regex.push("[$@$!%*#?&]"); //Special Character.

              var passed = 0;

              //Validate for each Regular Expression.
              for (var i = 0; i < regex.length; i++) {
                  if (new RegExp(regex[i]).test(password)) {
                      passed++;
                  }
              }

              //Validate for length of Password.
              if (passed > 2 && password.length > 8) {
                  passed++;
              }

              //Display status.
              var color = "";
              var strength = "";
              switch (passed) {
                  case 0:
                  case 1:
                      strength = "Weak";
                      color = "red";
                      break;
                  case 2:
                      strength = "Good";
                      color = "darkorange";
                      break;
                  case 3:
                  case 4:
                      strength = "Strong";
                      color = "green";
                      break;
                  case 5:
                      strength = "Very Strong";
                      color = "darkgreen";
                      break;
              }
              password_strength.innerHTML = strength;
              password_strength.style.color = color;
          }
      </script>

      <script language="javascript">

      function checkEmail() {

      var email = document.getElementById('txtEmail');
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (!filter.test(email.value)) {
      alert('Please provide a valid email address');
      email.focus;
      return false;
      }
      }
      </script>

  </body>
</html>
