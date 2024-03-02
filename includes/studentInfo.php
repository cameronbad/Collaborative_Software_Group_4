<?php
    require_once ("_connect.php");

    $sID = mysqli_real_escape_string($db_connect, $_GET['studentID']);

    $SQL = "CALL studentProfileUser($sID)"; //Calls the routine in the database which grabs all the data of a user

    $result = mysqli_query($db_connect, $SQL);

    $user = mysqli_fetch_assoc($result);
?>