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
if(isset($_POST['other_loan'])) {

    $Institution_=$_POST['Institution'];
    $Loan_amount_=$_POST['Loan_amount'];
    $Date_advanced_=$_POST['Date_advanced'];
    $Repayment_period_=$_POST['Repayment_period'];
    $Outstanding_amount_=$_POST['Outstanding_amount'];


    $sql = "INSERT INTO Other_Loans(

            User_email
            ,Institution
            ,Loan_amount
            ,Date_advanced
            ,Repayment_period
            ,Outstanding_amount
            
            ) VALUES(
            
               '$username',
               '$Institution_',
               '$Loan_amount_',
               '$Date_advanced_',
               '$Repayment_period_',
               '$Outstanding_amount_'
      
            )";

    if ($con->multi_query($sql) === TRUE) {

        header('Location: final.php?success');

    } else {

        header('Location: final.php?error');

        echo $con->error;

    }

    $con->close();
}
