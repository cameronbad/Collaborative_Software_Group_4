<?php
//User auth here

if (!isset($_POST['dTestID'])) {
    die("Please fill out all fields");
}

require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$id = $db_connect->real_escape_string($_POST['dTestID']);

//Prepare SQL Query
$query = "CALL deleteTest(?)";

if ($db_connect->execute_query($query, [$id]))
    echo "Delete succesful";
else
    echo "Error: " . $db_connect->error();
?>