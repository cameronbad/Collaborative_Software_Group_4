<?php
//User auth here

if (!isset($_POST['eSubjectSelect']) ||
    !isset($_POST['eName']) ||
    !isset($_POST['eAmount'])
) {
    die("Please fill out all fields");
}

require_once("includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = $db_connect->real_escape_string($_POST['eSubjectSelect']);
$name = $db_connect->real_escape_string($_POST['eName']);
$amount = $db_connect->real_escape_string($_POST['eAmount']);
$id = $db_connect->real_escape_string($_POST['eTestID']);

//Prepare SQL query
$query = "UPDATE `test` SET 
    `subjectID` = ?,
    `testName` = ?,
    `questionAmount` = ?
    WHERE `test`.`testID` = ?";
$stmt = $db_connect->prepare($query);

//Bind parameters
$stmt->bind_param("isii", $subject, $name, $amount, $id);

if ($stmt->execute())
    echo "Test updated succesfully";
else
    echo "Error: " . $db_connect->error();
?>
