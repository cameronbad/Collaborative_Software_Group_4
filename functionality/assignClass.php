<?php

include("../includes/_connect.php");

$classID = $db_connect->real_escape_string($_POST["assignClassName"]); //Grabs data from the modal
$userID = $db_connect->real_escape_string($_POST["assignClassUser"]);

$stmt = $db_connect->prepare("CALL checkMembership(?, ?)"); //perpares the query
$stmt->bind_param("ii", $userID, $classID); //Binds the parameters
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($checkMembership); //Stores the result into a variable


$stmt->fetch();

if($stmt->num_rows != 0){ //Checks to see if the user is already assigned to this class cause if a result is returned a connection exists
    echo "Student is already assigned to class.";
}
else{
    $stmt->close();

    $stmt = $db_connect->prepare("CALL assignUserClass(?, ?)"); //perpares the query
    $stmt->bind_param("ii", $classID, $userID); //Binds the parameters
    $stmt->execute();

    if ($stmt->affected_rows > 0) {//Checks if the query worked
        echo "Class Assigned";
    } else {
        echo "Error: " . $db_connect->error;
    }
}

$stmt->close();
$db_connect->close();

?>