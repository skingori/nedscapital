<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 15/01/2018
 * Time: 17:53
 */
/*
    * Database Configuration and Connection using mysqli
    */

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "root");
define("DB", "neds");
define("MyTable", "Neds_Pay");

$connection = mysqli_connect(HOST, USER, PASSWORD, DB) OR DIE("Impossible to access to DB : " . mysqli_connect_error());

/* END DB Config and connection */
