<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 15/01/2018
 * Time: 14:21
 */

//Start our session.
session_start();

include '../connection/db.php';

$username=$_SESSION['logname'];
//AUTO GENERATE CODE

$chars = array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T');
$serial = '';
$max = count($chars)-1;
for($i=0;$i<15;$i++){
    $serial .=(!($i % 3) && $i ? '-' : '').$chars[rand(0, $max)];
}
//INSERT DATA ON DB
if(isset($_POST['payoff'])) {

    $Pay_Amount=$_POST['Pay_Amount'];
    $Pay_Mode=$_POST['Pay_Mode'];
    $Pay_Code=$serial;
    $Pay_Ref=$_POST['Pay_Ref'];
    $Pay_Desc=$_POST['Pay_Desc'];
    $Pay_Loan_Code=$_POST['Pay_Loan_Code'];
    $Pay_Offer_Code=$_POST['Pay_Offer_Code'];
    $Pay_Usermail=$_POST['Pay_Usermail'];

    $sql = "INSERT INTO Neds_Pay(
          
             Pay_Amount
            ,Pay_Mode
            ,Pay_Code
            ,Pay_Ref
            ,Pay_Desc
            ,Pay_Loan_Code
            ,Pay_Offer_Code
            ,Pay_Usermail
            ,Pay_Date
            
           
            ) VALUES(
            
               '$Pay_Amount',
               '$Pay_Mode',
               '$Pay_Code',
               '$Pay_Ref',
               '$Pay_Desc',
               '$Pay_Loan_Code',
               '$Pay_Offer_Code',
               '$Pay_Usermail',
                NOW()
      
            )";

    if ($con->multi_query($sql) === TRUE) {

        header('Location: payments.php?success');

    } else {

        header('Location: payments.php?error');

        echo $con->error;

    }

    $con->close();
}
