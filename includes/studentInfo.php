<?php
    require_once ("_connect.php");

    $sID = $db_connect->real_escape_string($_GET['studentID']);

    $stmt = $db_connect->prepare("CALL studentProfileUser(?)"); //Prepares the statement
    $stmt->bind_param("i", $sID); //Binds the parameter
    $stmt->execute(); //Runs the query

    $stmt->store_result();
    $stmt->bind_result($userID, $username, $firstName, $lastName, $email, $studentNumber, $courseID, $accountState, $lastLogin); //Stores the result into a variable


    $stmt->fetch();

    $stmt->close();
    $db_connect->close();
?>