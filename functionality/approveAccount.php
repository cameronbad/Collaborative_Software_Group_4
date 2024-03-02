<?php
require("./includes/_connect.php");

$dID = mysqli_real_escape_string($db_connect, $_GET['sID']); // Grabs the Id from the url

$stmt = $db_connect->prepare("CALL approveUser(?)");
$stmt->bind_param("i", $dID);
$stmt->execute();

if ($stmt->affected_rows > 0) {//Checks if the query worked
    echo "Approved";
} else {
    echo "Error: " . mysqli_error($db_connect);
}

$stmt->close();
$db_connect->close();


?>