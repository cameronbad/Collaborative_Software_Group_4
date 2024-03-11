<?php
    require_once ('includes/_connect.php');

    $SQL = "CALL allCourseNames()";// Calls the procedure

    $result = mysqli_query($db_connect, $SQL);

    $preValue = '0';

    while($db_connect->next_result()){;} //Fixes Unsynch Error

    while($row = mysqli_fetch_assoc($result)){ //Loops through results and matches the subjects with the courses
        //if ($_SESSION['accessLevel'] >= '2') { Will add condition after we have session varaibles implemeted
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
        //}
    }
?>