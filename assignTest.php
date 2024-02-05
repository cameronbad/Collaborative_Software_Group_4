<?php
//User auth here

if (!isset($_POST['classSelect']) ||
    !isset($_POST['aTestID'])
) {
    die("Please fill out all fields");
}

require_once("includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$class = mysqli_real_escape_string($db_connect, $_POST['classSelect']);
$test = mysqli_real_escape_string($db_connect, $_POST['aTestID']);

//Get userID's of `class`, `member`


//Trim userID's of results that already exist


//Create results from all userID's according to the test

?>