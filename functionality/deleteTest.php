<?php
//User auth here

if (!isset($_POST['dTestID'])) {
    die("Please fill out all fields");
}

require_once("includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$id = mysqli_real_escape_string($db_connect, $_POST['dTestID']);

//Prepare SQL Query
$query = "DELETE FROM `test` WHERE `test`.`testID` = $id";

if (mysqli_query($db_connect, $query))
    echo "Delete succesful";
else
    echo "Error: " . mysqli_error($db_connect);
?>