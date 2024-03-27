<?php
@session_start();
if ($_SESSION['accessLevel'] == 1) {
    //Auth passed
} else if ($_SESSION['accessLevel'] == 2) {
    //Auth failed, teacher
    header("Location: ./studentDisplay");
    die();
} else if ($_SESSION['accessLevel'] == 3) {
    //Auth failed, admin
    header("Location: ./adminDashboard");
    die();
} else {
    //Not logged in
    header("Location: ./");
    die();
}

//Require php includes
require_once("./includes/_connect.php");
require_once("./includes/_functions.php");

//Declare variable
$resultID = $db_connect->real_escape_string($_GET['resultID']);

//Check if the session user is the same as the user assigned to this result.
$query = "CALL checkUser(?)";
$checkUser = $db_connect->execute_query($query, [$resultID])->fetch_assoc();

if ($checkUser['userID'] == $_SESSION['userID']) {
    //Auth passed
} else {
    //Not the correct user
    header("Location: ./testDashboard");
    die();
}


//Get test information for this result.
$query = "CALL getResultPage(?)";
$test = $db_connect->execute_query($query, [$resultID])->fetch_assoc();

//Array of all existing answers
$prevQuestions = [];
$prevChoice = [];
$prevCorrect = [];

//Get previous question's questionID
$query = "CALL getPreviousQuestions(?)";

$run = $db_connect->execute_query($query, [$resultID]);
while ($result = $run->fetch_assoc()) {
    $prevQuestions[] = $result['questionID'];
    $prevChoice[] = $result['chosenAnswer'];
    $prevCorrect[] = $result['correctAnswer'];
}

$_SESSION['testCurrent'] = count($prevQuestions);
$_SESSION['testTotal'] = $test['questionTotal'];

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
                <div class="navbar-text p-3"><span id='currentQuestion'><?= $_SESSION['testCurrent'] ?></span> of <?= $test['questionTotal'] ?></div>
            </div>    
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="includes/_functions.js"></script>
    <script>
        //First check for existing answers and append
        var prevQuestions = <?= json_encode($prevQuestions); ?>;
        var prevChoice = <?= json_encode($prevChoice); ?>;
        var prevCorrect = <?= json_encode($prevCorrect); ?>;
        var count = 0;

        if (prevQuestions.length === 0) {
            //Generates a new question
            makeQuestion(prevQuestions, <?= $test['subjectID'] ?>, <?= $resultID ?>).then(
                function(value) {
                    if(value){
                        prevQuestions.push(value);
                        currentQuestion('currentQuestion');
                    }
                }                
            )
        } else {
            //Run loop to make all previous questions.
            $.each(prevQuestions, function(index, value) {
                $.ajax({
                    url: "./includes/question.php",
                    method: "GET",
                    data: {questionID: value},
                    success: function(data) {
                        count++;
                        $('.test-container').append(data);

                        if (count != prevQuestions.length) {
                            checkQuestion(prevChoice[index], prevCorrect[index]);
                        } //Add function for moving user to active question after its been loaded, make sure it wont trigger if there is no active question.
                    }
                });
            });
        }

        //AJAX call to submit an answer
        $(document).on("click", '.question-active .answer-btn', function() {
            //Get the value of the button that triggered this
            var choice = $(this).attr("value");

            $.ajax({
                url: "./functionality/submitAnswer.php",
                method: "POST",
                data: {questionID: prevQuestions[prevQuestions.length - 1], resultID: <?= $resultID ?>, choice: choice}, 
                success: function(data) { 
                    //Marks answers
                    checkQuestion(choice, data);

                    //Checks if questions are done
                    if (prevQuestions.length >= <?= $test['questionTotal'] ?>) {
                        //End test
                        $.ajax({
                            url: "./includes/testEnd.php",
                            method: "GET",
                            data: {questionID: questionID},
                            success: function(data) {
                                $('.test-container').append(data);
                            }
                        });
                    } else {
                        //Generates a new question
                        makeQuestion(prevQuestions, <?= $test['subjectID'] ?>, <?= $resultID ?>).then(
                            function(value) {
                                if(value){
                                    prevQuestions.push(value);
                                    currentQuestion('currentQuestion');
                                }
                            }                
                        )
                    }
                }
            })
        });
    </script>
</body>
</html>