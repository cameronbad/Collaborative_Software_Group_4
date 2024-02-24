<?php
include_once("includes/_connect.php");  

$_GET['questionID'] = '1'; //temp

$query = "SELECT `question`.`questionText`, `question`.`answerA`, `question`.`answerB`, `question`.`answerC`, `question`.`answerD` FROM `question` WHERE `question`.`questionID` = " . $_GET['questionID'];
$question = $db_connect->execute_query($query)->fetch_assoc();

//Make array with answers assigned to value 1-4
$answers = array('1'=>$question['answerA'],'2'=>$question['answerB'],'3'=>$question['answerC'],'4'=>$question['answerD']);

//Shuffle the value/keys
$keys = array_keys($answers);
shuffle($keys);

?>
<div class="container position-absolute top-50 start-50 translate-middle card"> <!-- card is temp for styling-->
    <div class="row">
        <h3 class="text-center"><?= $question['questionText'] ?></h3>      
    </div>
    <div class="row">
        <div class="col"><?= $answers[$keys[0]] ?></div>
        <div class="col"><?= $answers[$keys[1]] ?></div>
    </div>
    <div class="row">
        <div class="col"><?= $answers[$keys[2]] ?></div>
        <div class="col"><?= $answers[$keys[3]] ?></div>
    </div>
</div>