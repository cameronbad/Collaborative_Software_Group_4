<?php
//User auth here

if (!isset($_POST['tSubjectSelect']) ||
    !isset($_POST['tName']) ||
    !isset($_POST['tAmount'])
) {
    die("Please fill out all fields");
}

require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = $db_connect->real_escape_string($_POST['tSubjectSelect']);
$name = $db_connect->real_escape_string($_POST['tName']);
$amount = $db_connect->real_escape_string($_POST['tAmount']);

//Prepare SQL query
$query = "CALL createTest(?, ?, ?)";

if ($db_connect->execute_query($query, [$subject, $name, $amount]))
    echo "Test created succesfully";
else
    echo "Error: " . $db_connect->error();
?>
