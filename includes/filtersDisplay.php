<?php //Check if this file is being included or called directly
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404); //Act like this page doesn't exist
    die();
}

    require_once ('_connect.php');

    $SQL = "CALL allCourseNames()";// Calls the procedure

    $run = $db_connect->query($SQL);

    $preValue = '0';
    
    while($result = $run->fetch_assoc()){ //Loops through results and matches the subjects with the courses
        if ($result['courseID'] == $_SESSION['courseID'] || $_SESSION['accessLevel'] == '3') {
            if($preValue == 0) { //If the first subject
                echo "<optgroup label=" . $result["courseName"] . ">"; 
                echo "<option value='" . $result["subjectID"] . "'>" . $result["subjectName"] . "</option>"; 
                $preValue = $result["courseID"]; 
            } 
            else if ($preValue != $result["courseID"]) { //If the subject is a different course than the previous subject
                echo "</optgroup>"; 
                echo "<optgroup label=" . $result["courseName"] . ">"; 
                echo "<option value='" . $result["subjectID"] . "'>" . $result["subjectName"] . "</option>"; 
                $preValue = $result["courseID"]; 
            } 
            else { //If the subject is the same course as the previous subject
                echo "<option value='" . $result["subjectID"] . "'>" . $result["subjectName"] . "</option>"; 
            }
        }
    }
    echo "</optgroup>";
?>