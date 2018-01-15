<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 14/01/2018
 * Time: 18:56
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
    $serial .=(!($i % 5) && $i ? '' : '').$chars[rand(0, $max)];
}
//INSERT DATA ON DB
if(isset($_POST['sendoff'])) {

    $Offer_Amount=$_POST['Offer_Amount'];
    $Offer_Amountwords=$_POST['Offer_Amountwords'];
    $Offer_Interest=$_POST['Offer_Interest'];
    $Offer_Total=$_POST['Offer_Total'];
    $iDate =$_POST['initialdate'];
    $Offer_Payment_Date=date('d/m/Y', strtotime($iDate.'+ 30 days'));
    $Offer_Loan_Code=$_POST['Offer_Loan_Code'];
    $Offer_Code=$serial;
    $Offer_Usermail=$_POST['Offer_Usermail'];
    $Offer_Start_Date=$iDate;

    $sql = "INSERT INTO Neds_Offer(
            
              Offer_Amount
            ,Offer_Amountwords
            ,Offer_Interest
            ,Offer_Total
            ,Offer_Payment_Date
            ,Offer_Loan_Code
            ,Offer_Code
            ,Offer_Usermail
            ,Offer_Start_Date
            ,Offer_Repayment_Status
            ,Offer_TimeStamp
           
            ) VALUES(
            
               '$Offer_Amount',
               '$Offer_Amountwords',
               '$Offer_Interest',
               '$Offer_Total',
               '$Offer_Payment_Date',
               '$Offer_Loan_Code',
               '$Offer_Code',
               '$Offer_Usermail',
               '$Offer_Start_Date',
               'Active',
                NOW()
      
            )";

    if ($con->multi_query($sql) === TRUE) {

        header('Location: approved.php?success');

    } else {

        header('Location: approved.php?error');

        echo $con->error;

    }

    $con->close();
}

?>