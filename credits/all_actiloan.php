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

    <!-- END OF CONTENT -->
<?php include 'post_cont.php';?>
<?php include 'footer.php';?>