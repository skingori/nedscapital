<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16/01/2018
 * Time: 13:41
 */

//Start our session.
session_start();

include '../connection/db.php';

$username=$_SESSION['logname'];
//AUTO GENERATE CODE

$chars = array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T');
$serial = '';
$max = count($chars)-1;
for($i=0;$i<10;$i++){
    $serial .=(!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
}

if(isset($_POST['disburse'])) {

    $Disburse_Amount=$_POST['Disburse_Amount'];
    $Disburse_Amountwords=$_POST['Disburse_Amountwords'];
    $Disburse_Interest=$_POST['Disburse_Interest'];
    $Disburse_Total=$_POST['Disburse_Total'];
    $iDate =$_POST['initialdate'];
    $Disburse_Payment_Date=date('Y-m-d', strtotime($iDate.'+ 30 days'));
    $Disburse_Loan_Code=$_POST['Disburse_Loan_Code'];
    $Disburse_Total=$_POST['Disburse_Total'];
    $Disburse_Code=$serial;
    $Disburse_Usermail=$_POST['Disburse_Usermail'];
    $Disburse_Start_Date=$iDate;
    $Disburse_Offer_Code=$_POST['Disburse_Offer_Code'];

    $sql = "INSERT INTO Neds_Disburse(
            
              Disburse_Amount
            ,Disburse_Amountwords
            ,Disburse_Interest
            ,Disburse_Total
            ,Disburse_Payment_Date
            ,Disburse_Loan_Code
            ,Disburse_Offer_Code
            ,Disburse_Code
            ,Disburse_Usermail
            ,Disburse_Start_Date
            ,Disburse_Repayment_Status
            ,Disburse_TimeStamp
           
            ) VALUES(
            
               '$Disburse_Amount',
               '$Disburse_Amountwords',
               '$Disburse_Interest',
               '$Disburse_Total',
               '$Disburse_Payment_Date',
               '$Disburse_Loan_Code',
               '$Disburse_Offer_Code',
               '$Disburse_Code',
               '$Disburse_Usermail',
               '$Disburse_Start_Date',
               'Active',
                NOW()
      
            )";

    if ($con->multi_query($sql) === TRUE) {

        header('Location: letters.php?success');

    } else {

        header("Location: letters.php?error=$con");

        echo $con->error;

    }

    $con->close();
}

