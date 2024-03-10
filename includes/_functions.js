//Marks buttons on an answer
function checkQuestion(choice, correct) { 
    $('.question-active').addClass('question-done'); //Set question as done
    $('.question-active button').addClass('disabled'); //Disable buttons

    if(choice == correct) {
        $('[value=' + choice + ']').addClass('answer-correct');
    } else {
        $('[value=' + choice + ']').addClass('answer-wrong');
        $('[value=' + correct + ']').addClass('answer-correct');
    }

    $('.question-done').removeClass('question-active'); //Remove active from done questions to prevent loops
}

//Appends a new question to page
function makeQuestion(doneQuestions, subjectID, resultID) {
    //Get question ID
    $.ajax({
        url: "./functionality/questionData.php",
        method: "GET",
        data: {prevQuestions: doneQuestions, subjectID: subjectID, resultID: resultID},
        success: function(data) {
            const result = data.split("|");
            const questionID = result[0];
            const position = result[1];

            //Generate question
            $.ajax({
                url: "./includes/question.php",
                method: "GET",
                data: {questionID: questionID},
                success: function(data) {
                    $('.test-container').append(data);

                    //Create new answer in database
                    $.ajax({
                        url: "./functionality/createAnswer.php",
                        method: "GET",
                        data: {questionID: questionID, resultID: resultID, position: position},
                        success: function(data) {
                            alert(data);
                        }
                    })
                }
            });
        }
    });
}

//Checks for a form being submitted and then posts it's data to a page
function ajaxFormSubmit(formID, pageURL) {
    $(formID).submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: pageURL,
            method: "POST",
            data: $(formID).serialize(),
            success: function(data) {
                alert(data); //Could use .html to make an in website alert with proper styling
            }
        })
    });
}