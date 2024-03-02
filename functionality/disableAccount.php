<?php
require("./includes/_connect.php");

$dID = mysqli_real_escape_string($db_connect, $user['userID']);

// Use prepared statement to enhance security
$stmt = $db_connect->prepare("CALL disableUser(?)");
$stmt->bind_param("i", $dID);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Disabled";
} else {
    echo "Error: " . mysqli_error($db_connect);
}

$stmt->close();
$db_connect->close();
?>