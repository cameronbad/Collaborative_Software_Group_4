<?php
//User auth here

if (!isset($_POST['tSubjectSelect']) ||
    !isset($_POST['tName']) ||
    !isset($_POST['tAmount'])
) {
    die("Please fill out all fields");
}

require_once("includes/_connect.php");

//Declare php variable's from post, creates a legal SQL string to avoid issues.
$subject = mysqli_real_escape_string($db_connect, $_POST['tSubjectSelect']);
$name = mysqli_real_escape_string($db_connect, $_POST['tName']);
$amount = mysqli_real_escape_string($db_connect, $_POST['tAmount']);

//Prepare SQL query
$query = "INSERT INTO `test` (`testID`, `subjectID`, `testName`, `questionAmount`) VALUES (NULL, ?, ?, ?)";
$stmt = mysqli_prepare($db_connect, $query);

//Bind parameters
mysqli_stmt_bind_param($stmt, "isi", $subject, $name, $amount);

if (mysqli_stmt_execute($stmt))
    echo "Test created succesfully";
else
    echo "Error: " . mysqli_error($db_connect);
?>
