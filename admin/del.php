<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 27/12/2017
 * Time: 04:18
 */

include("../connection/db.php");

if (isset($_GET['loa'])){
    //getting id of the data from url
    $id = $_GET['loa']; //deletin milk
    //deleting the row from table
    $result = mysqli_query($con, "DELETE FROM Other_Loans WHERE Id=$id ");
//$result = mysqli_query($con, "DELETE FROM login_table WHERE login_username=$id");

//redirecting to the display page (index.php in our case)
    header("Location:final.php");
}


if (isset($_GET['sec'])){
    $id =$_GET['sec']; //deleting feeds
    $result = mysqli_query($con, "DELETE FROM Security WHERE Id=$id ");
    header("Location:final.php");
}

if (isset($_GET['ap'])){
    $id =$_GET['ap']; //deleting feeds
    $result = mysqli_query($con, "DELETE FROM Officer_Table WHERE Officer_Id=$id ");
    header("Location:officers.php");

}

if (isset($_GET['payi'])){
    $id =$_GET['payi']; //deleting feeds
    $result = mysqli_query($con, "DELETE FROM Payment_Table WHERE Payment_code=$id ");
    header("Location:handled.php?msg");
}

if (isset($_GET['not'])){
    $id =$_GET['not']; //deleting feeds
    $result = mysqli_query($con, "DELETE FROM Notification_Table WHERE Notification_Id=$id ");
    header("Location:unhandled.php?msg");
}

if (isset($_GET['approve'])){
    $id =$_GET['approve']; //deleting feeds
    $result = mysqli_query($con, "UPDATE Loan SET Loan_Status='Approved' WHERE Loan_code=$id");

    header("Location:index.php");
}
if (isset($_GET['decline'])){
    $id =$_GET['decline']; //deleting feeds
    $result = mysqli_query($con, "UPDATE Loan SET Loan_Status='Declined' WHERE Loan_code=$id");

    header("Location:index.php");
}
if (isset($_GET['declinedel'])){
    $id =$_GET['declinedel']; //deleting feeds
    $result = mysqli_query($con, "DELETE FROM Loan WHERE Loan_code=$id");

    header("Location:declined.php");
}
if (isset($_GET['re-approve'])){
    $id =$_GET['re-approve']; //deleting feeds
    $result = mysqli_query($con, "UPDATE Loan SET Loan_Status='Application Sent' WHERE Loan_code=$id");

    header("Location:declined.php");
}
?>