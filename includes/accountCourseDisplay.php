<?php
    require ("_connect.php");

    $cID = $db_connect->real_escape_string($courseID); //Grabs the variable

    $stmt = $db_connect->prepare("CALL studentProfileCourse(?)"); //Prepares the statement
    $stmt->bind_param("i", $cID); //Binds the parameter

    $stmt->execute(); //Runs the query

    $stmt->store_result();
    $stmt->bind_result($courseName); //Stores the result into a variable

    while($stmt->fetch()){ //Displays the data
    echo $courseName;
    }

    $stmt->close(); //Closes the stmt
    $db_connect->close();

 ?>