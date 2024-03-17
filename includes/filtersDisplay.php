<?php
    require_once ('_connect.php');

    $SQL = "CALL allCourseNames()";// Calls the procedure

    $result = $db_connect->query($SQL);

    $preValue = '0';
    
    while($row = $result->fetch_assoc()){ //Loops through results and matches the subjects with the courses
        if ($row['courseID'] == $_SESSION['courseID'] || $_SESSION['accessLevel'] == '3') { // add this after session is fixed $_SESSION['courseID'] 
            if($preValue == 0) {
                echo "<optgroup label=" . $row["courseName"] . ">";
                echo "<option value='" . $row["subjectID"] . "'>" . $row["subjectName"] . "</option>";
                $preValue = $row["courseID"];
            } 
            else if ($preValue != $row["courseID"]) {
                echo "</optgroup>";
                echo "<optgroup label=" . $row["courseName"] . ">";
                echo "<option value='" . $row["subjectID"] . "'>" . $row["subjectName"] . "</option>";
                $preValue = $row["courseID"];
            } 
            else {
                echo "<option value='" . $row["subjectID"] . "'>" . $row["subjectName"] . "</option>";
            }
        }
    }
?>