<?php
session_start();
if (isset($_SESSION['rank'])!="" && isset($_SESSION['logname'])!="") {
    header("Location: sessions.php");
    exit;
}


require('connection/db.php');
// If form submitted, insert values into the database.
if (isset($_POST['login'])){

    $username = stripslashes($_REQUEST['Login_Username']); // removes backslashes
//$rank = stripslashes($_REQUEST['rank']); // removes backslashes
    $password = stripslashes($_REQUEST['Login_Password']);

    $username_ = mysqli_real_escape_string($con,$username); //escapes special characters in a string
//$rank_ = mysqli_real_escape_string($con,$rank); //escapes special characters in a string
    $password_ = mysqli_real_escape_string($con,$password);

    $enc = md5($password_);
//Checking is user existing in the database or not
    $query = "SELECT * FROM Login_Table WHERE Login_Username='$username_' AND Login_Password='$enc'";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);

    $rowCheck = mysqli_num_rows($result);
    $row= mysqli_fetch_array($result);

    if($row['Login_Rank']==1){

        $_SESSION['logname'] = $row['Login_Username'];
        $_SESSION['rank'] = $row['Login_Rank'];

        //below will be used as a welcome message
        $username=$_SESSION['logname'];

        $msg1 = "<div class='alert alert-success'>
                        <span class='glyphicon glyphicon-check'></span> &nbsp;Login Successful !! Welcome $username
                    </div>";


        ?>
        <p align="center">
            <meta content="0;admin/index.php?action=home" http-equiv="refresh" />
        </p>

        <?php


    } elseif ($row['Login_Rank']==2){

        $_SESSION['logname'] = $row['Login_Username'];
        $_SESSION['rank'] = $row['Login_Rank'];

        $msg2 = "<div class='alert alert-success'>
                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp;Login Successful !! Welcome
                    </div>";
        ?>

        <p align="center">
            <meta content="0;user/index.php" http-equiv="refresh" />
        </p>

        <?php

    }elseif ($row['Login_Rank']==3){

        $_SESSION['logname'] = $row['Login_Username'];
        $_SESSION['rank'] = $row['Login_Rank'];

        $msg3 = "<div class='alert alert-success'>
                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp;Login Successful !! Welcome
                    </div>";
        ?>


        <p align="center">
            <meta content="0;credits/index.php?action=home" http-equiv="refresh" />
        </p>

        <?php

    }

    else {
        ?>
        <?php

        $msg = "<div class='alert alert-danger'>
                        <span class='glyphicon glyphicon-lock'></span> &nbsp; Wrong username or Password !
                    </div>";

    }
}?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Ned Capital | Login</title>

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
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
                    <?php
                    if (isset($msg)) {
                        echo $msg;
                    }
                    ?>
		            <input type="email" name="Login_Username" class="form-control" placeholder="Registered Email" required autofocus>
		            <br>
		            <input type="password" name="Login_Password" class="form-control" placeholder="Password" required>
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="index.php#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" type="submit" name="login"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		            <div class="login-social-link centered">
		            <p>or you can sign in via your social network</p>
		                <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
		                <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
		            </div>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="signup.php">
		                    Create an account
		                </a>
		               
		            </div>
		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
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
        $.backstretch("assets/img/balance-865091_1920.jpg", {speed: 800});
    </script>


  </body>
</html>
