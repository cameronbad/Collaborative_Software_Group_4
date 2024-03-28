<?php
include_once("includes/_connect.php");
echo "opened";

$userName = mysqli_real_escape_string($db_connect, $_POST["username"]);
$userID = mysqli_real_escape_string($db_connect, $_POST["userID"]);
$firstName = mysqli_real_escape_string($db_connect, $_POST["firstName"]);
$lastName = mysqli_real_escape_string($db_connect, $_POST["lastName"]);
$email = mysqli_real_escape_string($db_connect, $_POST["email"]);
//Data Sanitisation to protect from SQL attacks

if (isset($_POST["userID"]) && isset($_POST["username"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"])) {
        

        $query = "UPDATE `user` SET `username` = '$userName',`firstName` = '$firstName',`lastName` = '$lastName',`email` = '$email' WHERE `userID` = '$userID';";
        echo $query;
        $run = mysqli_query($db_connect, $query);
     
    }
else {

}
header("Location:lecturerManagement.php");