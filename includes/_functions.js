function checkQuestion(choice, correct) { //Marks buttons on an answer
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

function makeQuestion(doneQuestions, subjectID) {
    $.ajax({
        url: "./includes/question.php",
        method: "GET",
        data: {prevQuestions: doneQuestions, subjectID: subjectID},
        success: function(data) {
            $('.test-container').append(data);
        }
    });
}

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