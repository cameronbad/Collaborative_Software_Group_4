<?php
//Require php includes
require_once("../includes/_functions.php");
require_once("../includes/_connect.php");
@session_start();

//Set variables
$subjectID = $db_connect->real_escape_string($_GET['subjectID']);
$resultID = $db_connect->real_escape_string($_GET['resultID']);

//Check authentication
if ($_SESSION['accessLevel'] == 1) {
    //Check if the user is the same as the user assigned to this result.
    $query = "CALL checkUser(?)";
    $checkUser = $db_connect->execute_query($query, [$resultID])->fetch_assoc();
    
    if ($checkUser['userID'] == $_SESSION['userID'] && $checkUser['subjectID'] == $subjectID) {
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

//Array of all questionID's
$questions = [];

$query = "CALL getQuestionList(?)";
$run = $db_connect->execute_query($query, [$subjectID]);

//Error check
if ($run === false) {
    die("Error: No questions to load.");
}

while ($result = $run->fetch_assoc()) {
    $questions[] = $result['questionID'];
}

//Takes ID of previously answered questions, makes a list of all questions which havent been generated and returns a random one
if (isset($_GET['prevQuestions'])) {
    $prevQuestions = $_GET['prevQuestions'];
    foreach ($prevQuestions as $prev) {     
        $key = array_search($prev, $questions);
        
        //Error check
        if ($key === false) {         
            //array_search failed due to invalid ID, skip
            continue;
        }
    
        unset($questions[$key]); //Removes index of already made answers from the question id list, this does not rearrange the indexes, so the index will be missing
    }
}

//Error check
if (count($questions) === 0)
{
    die("Error: All possible questions have been generated.");
}

//Shuffles $questions
shuffle($questions);

//Get position of new question
$query = "CALL getPosition(?)";
$run = $db_connect->execute_query($query, [$resultID])->fetch_assoc();

$position = $run['position'] + 1;

//Returns question ID
die ($questions[0] . "|" . $position);




?>