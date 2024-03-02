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

$profileUsername = mysqli_real_escape_string($db_connect, $_POST['studentProfileUsername']);
$profileName = mysqli_real_escape_string($db_connect, $_POST['studentProfileName']);
$profileSurname = mysqli_real_escape_string($db_connect, $_POST['studentProfileSurname']);
$profileEmail = mysqli_real_escape_string($db_connect, $_POST['studentProfileEmail']);
$profileID = mysqli_real_escape_string($db_connect, $_POST['studentProfileID']);

$stmt = $db_connect->prepare("CALL editStudentProfile(?, ?, ?, ?, ?)"); // Prepares the statements
$stmt->bind_param("issss", $profileID, $profileUsername, $profileName, $profileSurname, $profileEmail);
$stmt->execute();

if ($stmt->affected_rows > 0){ //Checks if it worked
    echo "Changes have been made to a user.";
}
else{
    echo "Error: " . mysqli_error($db_connect);
}

$stmt->close();
$db_connect->close();
?>