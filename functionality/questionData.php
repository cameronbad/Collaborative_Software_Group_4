<?php
//Add Authentication

require_once("../includes/_connect.php");

//Takes ID of previously answered questions, makes a list of all questions which havent been generated and returns a random one
$prevQuestions = $_GET['prevQuestions'];
$subjectID = $_GET['subjectID'];
$resultID = $_GET['resultID'];

$query = "SELECT `question`.`questionID` FROM `question` WHERE `question`.`subjectID` = " . $subjectID;

//Array of all questionID's
$questions = [];

$run = $db_connect->execute_query($query);

//Error check
if ($run === false) {
    die("Error: No questions to load.");
}

while ($result = $run->fetch_assoc()) {
    $questions[] = $result['questionID'];
}

foreach ($prevQuestions as $prev) {     
    $key = array_search($prev, $questions);
    
    //Error check
    if ($key === false) {         
        //array_search failed due to invalid ID, skip
        continue;
    }

    unset($questions[$key]); //Removes index of already made answers from the question id list, this does not rearrange the indexes, so the index will be missing
}

//Error check
if (count($questions) === 0)
{
    die("Error: All possible questions have been generated.");
}

//Shuffles $questions
shuffle($questions);

//Get position of new question
$query = "SELECT COUNT(`answer`.`answerID`) as position FROM `answer` WHERE `answer`.`resultID` = " . $resultID;
$run = $db_connect->execute_query($query)->fetch_assoc();

$position = $run['position'] + 1;

//Returns question ID
die ($questions[0] . "|" . $position);




?>