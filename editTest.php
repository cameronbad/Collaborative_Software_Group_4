<?php


if (!isset($_POST['eSubjectSelect']) ||
    !isset($_POST['eName']) ||
    !isset($_POST['eAmount'])
) {
    die("Please fill out all fields");
}

require_once("includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = mysqli_real_escape_string($db_connect, $_POST['eSubjectSelect']);
$name = mysqli_real_escape_string($db_connect, $_POST['eName']);
$amount = mysqli_real_escape_string($db_connect, $_POST['eAmount']);
$id = mysqli_real_escape_string($db_connect, $_POST['eTestID']);

//Prepare SQL query
$query = "UPDATE `test` SET 
    `subjectID` = ?,
    `testName` = ?,
    `questionAmount` = ?
    WHERE `test`.`testID` = $id";
$stmt = mysqli_prepare($db_connect, $query);

//Bind parameters
mysqli_stmt_bind_param($stmt, "isi", $subject, $name, $amount);

if (mysqli_stmt_execute($stmt))
    echo "Test updated succesfully";
else
    echo "Error: " . mysqli_error($db_connect);
?>
