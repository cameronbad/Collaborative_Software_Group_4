<?php
    include_once ('_connect.php');

    $SQL = "CALL onlyCourses()";// Calls the procedure

    while($db_connect->next_result()){;} //Fixes Unsynch Error
    
    $run = $db_connect->query($SQL);

    echo "<optgroup>";
    while($result = $run->fetch_assoc()){ //Loops through results creating dropdown options
        echo "<option value='" . $result["courseID"] . "'>" . $result["courseName"] . "</option>"; 
    }
    echo "</optgroup>";
?>