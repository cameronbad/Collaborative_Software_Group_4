<?php
//User auth here / Only user doing the test should be able to access the page.
@session_start();

//need to $_GET the result ID
$_GET['resultID'] = '13'; //temp

require_once("./includes/_connect.php");

$query = "SELECT `test`.`testName`, `test`.`subjectID`, `subject`.`subjectName`, `result`.`questionTotal`, `result`.`questionCurrent` FROM `result` LEFT JOIN `test` ON `result`.`testID` = `test`.`testID` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID` WHERE `result`.`resultID` = " . $_GET['resultID'];
$test = $db_connect->execute_query($query)->fetch_assoc();
$current = $test['questionCurrent'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTest | Test | <?= $test['testName'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
</head>
<body class="d-flex flex-column h-100 test-body">
    <main class="flex-shrink-0">
        <!-- Load Navbar -->
        <?php include_once("includes/navbar.php"); ?>
        <div class="test-container"> <!-- Question content / fullpage scrolling -->
            <!-- Question / Answers / Submit || Add each question to this container / Existing answers get added on load (initial one created  on first load?)
            Later answers get added by ajax query using page template? -->
        </div>  

        <!-- Bottom Bar -->
        <div class="navbar fixed-bottom test-bottom">
            <div class="navbar-nav flex-row">
                <div class="navbar-text p-3"><?= $test['subjectName'] ?></div>
                <svg class="test-bottom-svg d-inline-block align-text-top">
                    <polygon points='0,0 0,56 30,0'>
                </svg>  
                <div class="navbar-text p-3"><?= $test['testName'] ?></div>
            </div>
            <div class="navbar-nav flex-row">
                <svg class="test-bottom-svg d-inline-block align-text-top">
                    <polygon points='30,56 0,56 30,0'>
                </svg>  
                <div class="navbar-text p-3"><?= $current //This needs to update with javascript ?> of <?= $test['questionTotal'] ?></div>
            </div>    
        </div>
    </main>
    <?php 
    $query = "SELECT `question`.`questionID` FROM `question` WHERE `question`.`subjectID` = " . $test['subjectID'];

    //Array of all questionID's
    $questions = [];

    $run = $db_connect->query($query);
    while ($result = $run->fetch_assoc()) {
        $questions[] = $result['questionID'];
    }

    $query = "SELECT `answer`.`chosenAnswer`, `answer`.`questionPosition`, `answer`.`questionID`, `question`.`correctAnswer` FROM `answer` LEFT JOIN `question` ON `answer`.`questionID` = `question`.`questionID` WHERE `resultID` = " . $_GET['resultID'] . " ORDER BY `answer`.`questionPosition` ASC"; 

    //Array of all existing answers
    $prevQuestions = [];
    $prevChoice = [];
    $prevCorrect = [];

    $run = $db_connect->query($query);
    while ($result = $run->fetch_assoc()) {
        $prevQuestions[] = $result['questionID'];
        $prevChoice[] = $result['chosenAnswer'];
        $prevCorrect[] = $result['correctAnswer'];
        $key = array_search($result['questionID'], $questions);
        unset($questions[$key]); //Removes index of already made answers from the question id list, this does not rearrange the indexes, so the index will be missing
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        //First check for existing answers and append
        var prevQuestions = <?= json_encode($prevQuestions); ?>;
        var prevChoice = <?= json_encode($prevChoice); ?>;
        var prevCorrect = <?= json_encode($prevCorrect); ?>;
        var count = 0;

        $.each(prevQuestions, function(index, value) {
            $.ajax({
                url: "./includes/question.php",
                method: "GET",
                data: {questionID: value},
                success: function(data) {
                    count++;
                    $('.test-container').append(data);

                    if (count != prevQuestions.length) {
                        $('.question-active').addClass('question-done'); //Set question as done
                        $('.question-active button').addClass('disabled'); //Disable buttons

                        if(prevChoice[index] == prevCorrect[index]) {
                            $('[value=' + prevChoice[index] + ']').addClass('answer-correct');
                        } else {
                            $('[value=' + prevChoice[index] + ']').addClass('answer-wrong');
                            $('[value=' + prevCorrect[index] + ']').addClass('answer-correct');
                        }

                        $('.question-done').removeClass('question-active'); //Remove active from done questions to prevent loops
                    } //Add function for moving user to active question after its been loaded, make sure it wont trigger if there is no active question.
                }
            });
        });

        //AJAX call to submit an answer
        $(document).on("click", '.question-active .answer-btn', function() {
            $.ajax({
                url: "./functionality/submitAnswer.php",
                method: "POST",
                data: {answerID:'2'}, //Placeholder, replace with proper way to get it
                success: function(data) { //Should return "chosenAnswer|correctAnswer" i.e. "4|4" or "1|3"
                    alert(data);
                    const result = data.split("|");

                    $('.question-active').addClass('question-done'); //Set question as done
                    $('.question-active button').addClass('disabled'); //Disable buttons

                    if (result[0] == result[1]) {
                        $('[value=' + result[0] + ']').addClass('answer-correct');
                    } else {
                        $('[value=' + result[0] + ']').addClass('answer-wrong');
                        $('[value=' + result[1] + ']').addClass('answer-correct');
                    }
                    
                }
            })
        });

        //Finally append new answers from list of available questions



    </script>
</body>
</html>