<?php
require("./includes/_connect.php");

$dID = mysqli_real_escape_string($db_connect, $_GET['sID']);
 
$SQL = "CALL approveUser($dID)";
 
if($db_connect->query($SQL)){
    echo "Approved";
}
else{
    echo "Error";
}

?>