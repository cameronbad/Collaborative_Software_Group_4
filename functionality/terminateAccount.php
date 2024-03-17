<?php
require("./includes/_connect.php");

$dID = $db_connect->real_escape_string($_GET['sID']); // Grabs the Id from the url

$stmt = $db_connect->prepare("CALL terminateStudent(?)");
$stmt->bind_param("i", $dID);
$stmt->execute();

if ($stmt->affected_rows > 0) {//Checks if the query worked
    echo "Approved";
} else {
    echo "Error: " . $db_connect->error;
}

$stmt->close();
$db_connect->close();


?>