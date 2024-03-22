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

function testCheck($testID, $courseID) {
    if ($_SESSION['accessLevel'] == 3) {
        //Auth passed, admin
    } else if ($_SESSION['accessLevel'] == 2 ) {
        //Check if the course of the test matches the the courseID given
        $query = "CALL checkTest(?)";
        $checkTest = $db_connect->execute_query($query, [$testID])->fetch_assoc();

        if ($checkTest['courseID'] != $courseID) {
            //Auth failed, teacher is attempting to edit a test from a different course
            header("Location: ./studentDisplay");
            die();
        }

    } else if ($_SESSION['accessLevel'] == 1) {
        //Auth failed, student
        header("Location: ./testDashboard");
        die();
    } else {
        //Not logged in
        header("Location: ./");
        die();
    }
}

function classCheck($classID, $courseID) {
    //Check if the course of the class matches the courseID given
    $query = "CALL checkClass(?)";
    $checkClass = $db_connect->execute_query($query, [$classID])->fetch_assoc();

    if ($checkClass['courseID'] != $courseID) {
        //Auth failed, teacher is attempting to edit a class from a different course
        header("Location: ./studentDisplay");
        die();
    }
}

function subjectCheck($subjectID, $courseID) {
    //Check if the course of the subject matches the courseID given
    $query = "CALL checkSubject(?)";
    $checkClass = $db_connect->execute_query($query, [$subjectID])->fetch_assoc();

    if ($checkClass['courseID'] != $courseID) {
        //Auth failed, teacher is attempting to edit a subject from a different course
        header("Location: ./studentDisplay");
        die();
    }
}
?>