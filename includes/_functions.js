//Marks buttons on an answer
function checkQuestion(choice, correct) { 
    $('.question-active').addClass('question-done'); //Set question as done
    $('.question-active button').addClass('disabled'); //Disable buttons

    if(choice == correct) {
        $('.question-active [value=' + choice + ']').addClass('answer-correct');
    } else {
        $('.question-active [value=' + choice + ']').addClass('answer-wrong');
        $('.question-active [value=' + correct + ']').addClass('answer-correct');
    }

    $('.question-done').removeClass('question-active'); //Remove active from done questions to prevent loops
}

//Appends a new question to page
async function makeQuestion(doneQuestions, subjectID, resultID) {
    //Declare variables
    var questionID;
    var position;

    let promise = new Promise(function(resolve) {
        //Get question ID
        function getID(doneQuestions) {
            $.ajax({
                url: "./functionality/questionData.php",
                method: "GET",
                data: {prevQuestions: doneQuestions, subjectID: subjectID, resultID: resultID},
                success: function(data) {
                    const result = data.split("|");
                    questionID = result[0];
                    position = result[1];
                    appendTest();
                }
            });
        }
        //Get question ID
        function getID() {
            $.ajax({
                url: "./functionality/questionData.php",
                method: "GET",
                data: {subjectID: subjectID, resultID: resultID},
                success: function(data) {
                    const result = data.split("|");
                    questionID = result[0];
                    position = result[1];
                    appendTest();
                }
            });
        }

        //Append test
        function appendTest() {
            $.ajax({
                url: "./includes/question.php",
                method: "GET",
                data: {questionID: questionID},
                success: function(data) {
                    $('.test-container').append(data);
                    createAnswer();
                }
            });
        }

        //Create new answer
        function createAnswer() {
            $.ajax({
                url: "./functionality/createAnswer.php",
                method: "GET",
                data: {questionID: questionID, resultID: resultID, position: position},
                success: function(data) {
                    resolve(questionID);
                }
            })
        }
 
        if(doneQuestions.length == 0) {
            getID();
        } else {
            getID(doneQuestions);
        }

    });

    var ID = await promise;
    return ID;
}

function testEnd() {
    //End test
    $.ajax({
        url: "./includes/testEnd.php",
        method: "GET",
        success: function(data) {
            $('.test-container').append(data);
        }
    });
}

//Checks for a form being submitted and then posts it's data to a page
function ajaxFormSubmit(formID, pageURL, practice) {
    $(formID).submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: pageURL,
            method: "POST",
            data: $(formID).serialize() + "&practice=" + practice,
            success: function(data) {
                alert(data); //Could use .html to make an in website alert with proper styling
            }
        })
    });
}

function currentQuestion(textID) {
    $.get("./functionality/getCurrent.php", function(data) {
        $(textID).text(data);
    })
}