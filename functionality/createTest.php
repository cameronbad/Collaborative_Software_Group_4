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
$subject = $db_connect->real_escape_string($_POST['tSubjectSelect']);
$name = $db_connect->real_escape_string($_POST['tName']);
$amount = $db_connect->real_escape_string($_POST['tAmount']);

//Prepare SQL query
$query = "INSERT INTO `test` (`testID`, `subjectID`, `testName`, `questionAmount`) VALUES (NULL, ?, ?, ?)";
$stmt = $db_connect->prepare($query);

//Bind parameters
$stmt->bind_param("isi", $subject, $name, $amount);

if ($stmt->execute())
    echo "Test created succesfully";
else
    echo "Error: " . $db_connect->error();
?>
