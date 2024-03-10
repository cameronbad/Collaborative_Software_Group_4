<?php
include_once("_connect.php");  
include_once("_functions.php");

if(isset($_GET['questionID'])) {
    $questionID = $_GET['questionID'];
} 
elseif (isset($_GET['prevQuestions'])) {
    $questionID = shuffleQuestion($_GET['prevQuestions'], $_GET['subjectID'], $db_connect);

    //Generate question in database

}
else {
    die('Error: No valid data entered.');
}

$query = "SELECT `question`.`questionText`, `question`.`answerA`, `question`.`answerB`, `question`.`answerC`, `question`.`answerD` FROM `question` WHERE `question`.`questionID` = " . $questionID;
$question = $db_connect->execute_query($query)->fetch_assoc();

//Make array with answers assigned to value 1-4
$answers = array('1'=>$question['answerA'],'2'=>$question['answerB'],'3'=>$question['answerC'],'4'=>$question['answerD']);

//Shuffle the value/keys
$keys = array_keys($answers);
shuffle($keys);

?>
<div class="container test-box"> 
    <div class="top-50 start-50 translate-middle card question-active"> <!-- card is temp for styling-->
        <div class="row">
            <h3 class="text-center"><?= $question['questionText'] ?></h3>      
        </div>
        <div class="row">
            <div class="col"><button class="btn btn-primary answer-btn" value="<?= $keys[0] ?>"><?= $answers[$keys[0]] ?></button></div>
            <div class="col"><button class="btn btn-primary answer-btn" value="<?= $keys[1] ?>"><?= $answers[$keys[1]] ?></button></div>
        </div>
        <div class="row">
            <div class="col"><button class="btn btn-primary answer-btn" value="<?= $keys[2] ?>"><?= $answers[$keys[2]] ?></button></div>
            <div class="col"><button class="btn btn-primary answer-btn" value="<?= $keys[3] ?>"><?= $answers[$keys[3]] ?></button></div>
        </div>
    </div>
</div>