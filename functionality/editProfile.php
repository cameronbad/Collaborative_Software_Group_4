<?php

if (!isset($_POST['studentProfileUsername']) || //Checks the fields were filled in
    !isset($_POST['studentProfileName']) ||
    !isset($_POST['studentProfileSurname']) ||
    !isset($_POST['studentProfileEmail']) ||
    !isset($_POST['studentProfileID'])
) {
    die("Please fill out all the fields");
}

require_once("../includes/_connect.php");

$profileUsername = $db_connect->real_escape_string($_POST['studentProfileUsername']);
$profileName = $db_connect->real_escape_string($_POST['studentProfileName']);
$profileSurname = $db_connect->real_escape_string($_POST['studentProfileSurname']);
$profileEmail = $db_connect->real_escape_string($_POST['studentProfileEmail']);
$profileID = $db_connect->real_escape_string($_POST['studentProfileID']);

$stmt = $db_connect->prepare("CALL editStudentProfile(?, ?, ?, ?, ?)"); // Prepares the statements
$stmt->bind_param("issss", $profileID, $profileUsername, $profileName, $profileSurname, $profileEmail);
$stmt->execute();

if ($stmt->affected_rows > 0){ //Checks if it worked
    echo "Changes have been made to a user.";
}
else{
    echo "Error: " . $db_connect->error;
}

$stmt->close();
$db_connect->close();
?>