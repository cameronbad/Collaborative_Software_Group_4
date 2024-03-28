<?php
    include('_connect.php');

    $SQL = "CALL allClasses()";// Calls the procedure

    while($db_connect->next_result()){;} //Fixes Unsynch Error
    
    $run = $db_connect->query($SQL);

    echo "<optgroup>";
    while($result = $run->fetch_assoc()){ //Loops through results creating dropdown options
        if($result["courseID"] == $courseID){
        echo "<option value='" . $result["classID"] . "'>" . $result["className"] . "</option>"; 
        }
    }
    echo "</optgroup>";
?>