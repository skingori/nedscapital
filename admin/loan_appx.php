<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 27/12/2017
 * Time: 02:14
 */

//Start our session.
session_start();

include '../connection/db.php';

$username=$_SESSION['logname'];

//INSERT DATA ON DB
if(isset($_POST['other_sec'])) {
    move_uploaded_file($_FILES["Security_upload"]["tmp_name"], '../upload/' . $_FILES["Security_upload"]["name"]);

    $Security_type_=$_POST['Security_type'];
    $Security_value_=$_POST['Security_value'];
    $Security_details_=$_POST['Security_details'];
    $Security_upload_='../upload/' . $_FILES["Security_upload"]["name"];


    $sql = "INSERT INTO Security(

            Security_usermail
            ,Security_type
            ,Security_value
            ,Security_details
            ,Security_upload
            
            
            ) VALUES(
            
               '$username',
               '$Security_type_',
               '$Security_value_',
               '$Security_details_',
               '$Security_upload_'
      
            )";

    if ($con->multi_query($sql) === TRUE) {

        header('Location: final.php?success');

    } else {

        header('Location: final.php?error');

        echo $con->error;

    }

    $con->close();
}
