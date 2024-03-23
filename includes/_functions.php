<?php @session_start();
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

function testCheck($db_connect, $ID, $courseID, $type) {
    if ($_SESSION['accessLevel'] == 3) {
        //Auth passed, admin
    } else if ($_SESSION['accessLevel'] == 2 ) {
        if ($type == 'Test' || $type == 'Class' || $type == 'Subject') {
            //Type is used correctly

            //Check if the course matches the the courseID given
            $query = "CALL check" . $type . "(?)";
            $check = $db_connect->execute_query($query, [$ID])->fetch_assoc();

            if ($check['courseID'] != $courseID) {
                //Auth failed, teacher is attempting to edit a test from a different course
                header("Location: ./studentDisplay");
                die();
            }
        } else {
            //Type is being inputted incorrectly, this is an error.
            error_log('Type is being inputted incorrectly in testCheck()');
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

function resultCheck($db_connect, $ID, $userID) {
    if ($_SESSION['accessLevel'] == 1) {
        //Check if the user is the same as the user assigned to this result.
        $query = "CALL checkUser(?)";
        $checkUser = $db_connect->execute_query($query, [$resultID])->fetch_assoc();

        if ($checkUser['userID'] == $userID) {
            //Auth passed
        } else {
            //Not the correct user/attempted data manipulation
            header("Location: ./testDashboard");
            die();
        }
    } else if ($_SESSION['accessLevel'] == 2) {
        //Auth failed, teacher
        header("Location: ../studentDisplay");
        die();
    } else if ($_SESSION['accessLevel'] == 3) {
        //Auth failed, admin
        header("Location: ../adminDashboard");
        die();
    } else {
        //Not logged in
        header("Location: ../");
        die();
    }
}
?>