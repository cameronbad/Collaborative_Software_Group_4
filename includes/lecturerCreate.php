<?php
include_once("includes/_connect.php");

$userName = mysqli_real_escape_string($db_connect, $_POST["username"]);
$userID = mysqli_real_escape_string($db_connect, $_POST["userID"]);
$firstName = mysqli_real_escape_string($db_connect, $_POST["firstName"]);
$lastName = mysqli_real_escape_string($db_connect, $_POST["lastName"]);
$email = mysqli_real_escape_string($db_connect, $_POST["email"]);
$password = mysqli_real_escape_string($db_connect, $_POST["password"]);
$courseID = mysqli_real_escape_string($db_connect, $_POST["addCourse"]);
//Data Sanitisation to protect from SQL attacks


if (isset($userName) && isset($firstName) && isset($lastName) && isset($email) && isset($password) && isset($courseID)) {
    
        // Password Hasher
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $accessLevel = 2;
        $studentNumber = NULL;

        $query = "INSERT INTO `user` (`userID`, `username`, `firstName`, `lastName`, `email`, `password`, `courseID`, `accessLevel`, `studentNumber`) VALUES ('$userID', '$userName', '$firstName', '$lastName', '$email', '$hashedPassword', '$courseID', '$accessLevel', '$studentNumber');";
        $run = mysqli_query($db_connect, $query);
        
        echo $query;

        if ($run) {
            echo '<div class="alert alert-success" role="alert">New user has been added.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Failed to add new user.</div>';
        }
        //Insert Query
    }

    header("Location:lecturerManagement.php");
?>