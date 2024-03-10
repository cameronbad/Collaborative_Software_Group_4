<?php
require("_connect.php");

//Takes ID of previously answered questions, makes a list of all questions which havent been generated and returns a random one
function shuffleQuestion($prevQuestions, $subjectID, $db_connect) {

    $query = "SELECT `question`.`questionID` FROM `question` WHERE `question`.`subjectID` = " . $subjectID;

    //Array of all questionID's
    $questions = [];
    
    $run = $db_connect->query($query);

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

    //Returns question ID
    return $questions[0];
}



?>