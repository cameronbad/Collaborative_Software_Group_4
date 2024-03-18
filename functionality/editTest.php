<?php
//User auth here

if (!isset($_POST['eSubjectSelect']) ||
    !isset($_POST['eName']) ||
    !isset($_POST['eAmount'])
) {
    die("Please fill out all fields");
}

require_once("../includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = $db_connect->real_escape_string($_POST['eSubjectSelect']);
$name = $db_connect->real_escape_string($_POST['eName']);
$amount = $db_connect->real_escape_string($_POST['eAmount']);
$id = $db_connect->real_escape_string($_POST['eTestID']);

//Prepare SQL query
$query = "CALL editTest(?, ?, ?, ?)";

if ($db_connect->execute_query($query, [$subject, $name, $amount, $id]))
    echo "Test updated succesfully";
else
    echo "Error: " . $db_connect->error();
?>
