<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 24/12/2017
 * Time: 17:18
 */

//CONVERT TO WORDS
$ones = array(
 "",
 " one",
 " two",
 " three",
 " four",
 " five",
 " six",
 " seven",
 " eight",
 " nine",
 " ten",
 " eleven",
 " twelve",
 " thirteen",
 " fourteen",
 " fifteen",
 " sixteen",
 " seventeen",
 " eighteen",
 " nineteen"
);

$tens = array(
 "",
 "",
 " twenty",
 " thirty",
 " forty",
 " fifty",
 " sixty",
 " seventy",
 " eighty",
 " ninety"
);

$triplets = array(
 "",
 " thousand",
 " million",
 " billion",
 " trillion",
 " quadrillion",
 " quintillion",
 " sextillion",
 " septillion",
 " octillion",
 " nonillion"
);

 // recursive fn, converts three digits per pass
function convertTri($num, $tri) {
  global $ones, $tens, $triplets;

  // chunk the number, ...rxyy
  $r = (int) ($num / 1000);
  $x = ($num / 100) % 10;
  $y = $num % 100;

  // init the output string
  $str = "";

  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " hundred";

  // do ones and tens
  if ($y < 20)
   $str .= $ones[$y];
  else
   $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];

  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != "")
   $str .= $triplets[$tri];

  // continue recursing?
  if ($r > 0)
   return convertTri($r, $tri+1).$str;
  else
   return $str;
 }

// returns the number as an anglicized string
function convertNum($num) {
 $num = (int) $num;    // make sure it's an integer

 if ($num < 0)
  return "negative".convertTri(-$num, 0);

 if ($num == 0)
  return "zero";

 return convertTri($num, 0);
}

 // Returns an integer in -10^9 .. 10^9
 // with log distribution
 function makeLogRand() {
  $sign = mt_rand(0,1)*2 - 1;
  $val = randThousand() * 1000000
   + randThousand() * 1000
   + randThousand();
  $scale = mt_rand(-9,0);

  return $sign * (int) ($val * pow(10.0, $scale));
 }

//Start our session.
session_start();

include '../connection/db.php';

$username=$_SESSION['logname'];
//AUTO GENERATE CODE

$chars = array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T');
$serial = '';
$max = count($chars)-1;
for($i=0;$i<16;$i++){
    $serial .= (!($i % 4) && $i ? '-' : '').$chars[rand(0, $max)];
}

//INSERT DATA ON DB
if(isset($_POST['get_loan'])) {

    move_uploaded_file($_FILES["Loan_bus_map"]["tmp_name"], '../upload/' . $_FILES["Loan_bus_map"]["name"]);


    $Loan_code=$serial;
    $Loan_useremail=$username;
    $Loan_type=$_POST['Loan_type'];
    $Loan_amount=$_POST['Loan_amount'];
    $Loan_amount_words=convertNum($_POST['Loan_amount']);
    $Loan_purpose=$_POST['Loan_purpose'];
    $Loan_tenure=$_POST['Loan_tenure'];
    $Loan_repayments=$_POST['Loan_repayments'];
    $Loan_project_cost=$_POST['Loan_project_cost'];
    $Loan_project_contrib=$_POST['Loan_project_contrib'];
    $Loan_guarantor_name=$_POST['Loan_guarantor_name'];
    $Loan_guarantor_id=$_POST['Loan_guarantor_id'];
    $Loan_guarantor_mobile=$_POST['Loan_guarantor_mobile'];
    $Loan_guarantor_email=$_POST['Loan_guarantor_email'];
    $Loan_guarantor_resd=$_POST['Loan_guarantor_resd'];
    $Loan_guarantor_rstat=$_POST['Loan_guarantor_rstat'];
    $Loan_bus_name=$_POST['Loan_bus_name'];
    $Loan_bus_natu=$_POST['Loan_bus_natu'];
    $Loan_bus_town=$_POST['Loan_bus_town'];
    $Loan_bus_building=$_POST['Loan_bus_building'];
    $Loan_bus_address=$_POST['Loan_bus_address'];
    $Loan_bus_yrs=$_POST['Loan_bus_yrs'];
    $Loan_bus_map= '../upload/' . $_FILES["Loan_bus_map"]["name"];
    $Loan_bus_street=$_POST['Loan_bus_street'];

    $sql = "INSERT INTO Loan(
            Loan_code
            ,Loan_useremail
            ,Loan_type
            ,Loan_amount
            ,Loan_amount_words
            ,Loan_purpose
            ,Loan_tenure
            ,Loan_repayments
            ,Loan_project_cost
            ,Loan_project_contrib
            ,Loan_guarantor_name
            ,Loan_guarantor_id
            ,Loan_guarantor_mobile
            ,Loan_guarantor_email
            ,Loan_guarantor_resd
            ,Loan_guarantor_rstat
            ,Loan_bus_name
            ,Loan_bus_natu
            ,Loan_bus_town
            ,Loan_bus_building
            ,Loan_bus_address
            ,Loan_bus_yrs
            ,Loan_bus_map
            ,Loan_bus_street
            ,Loan_Status
            ,Loan_appl_time
            
            ) VALUES(
            
               '$Loan_code',
               '$Loan_useremail',
               '$Loan_type',
               '$Loan_amount',
               '$Loan_amount_words',
               '$Loan_purpose',
               '$Loan_tenure',
               '$Loan_repayments',
               '$Loan_project_cost',
               '$Loan_project_contrib',
               '$Loan_guarantor_name',
               '$Loan_guarantor_id',
               '$Loan_guarantor_mobile',
               '$Loan_guarantor_email',
               '$Loan_guarantor_resd',
               '$Loan_guarantor_rstat',
               '$Loan_bus_name',
               '$Loan_bus_natu',
               '$Loan_bus_town',
               '$Loan_bus_building',
               '$Loan_bus_address',
               '$Loan_bus_yrs',
               '$Loan_bus_map',
               '$Loan_bus_street',
               'Application Sent',
                NOW()
      
            )";

    if ($con->multi_query($sql) === TRUE) {

            header('Location: loan_appb.php?success');

    } else {

            header('Location: loan_appb.php?error');

        echo $con->error;

    }

    $con->close();
}

?>