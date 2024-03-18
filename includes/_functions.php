<?php
require("_connect.php");

function getSubjectID($db_connect){
    $stmt = $db_connect->prepare("CALL subjectFromCourse(?)"); //Finds the subject id from the course id
    $stmt->bind_param("i", $_SESSION['courseID']);

    $stmt->execute();

    $stmt->store_result();
    $stmt->bind_result($subjectID);

    while($stmt->fetch()){ //Retrieves results from an array format
    $IDPure = $subjectID;
    }

    return $IDPure; //Returns the final value
}

?>