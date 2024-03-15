<?php
//User auth here

if (!isset($_POST['dTestID'])) {
    die("Please fill out all fields");
}

require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$id = $db_connect->real_escape_string($_POST['dTestID']);

//Prepare SQL Query
$query = "DELETE FROM `test` WHERE `test`.`testID` = ?";
$stmt = $db_connect->prepare($query);

//Bind parameters
$stmt->bind_param("i", $id);

if ($stmt->execute())
    echo "Delete succesful";
else
    echo "Error: " . $db_connect->error();
?>