<?php
    require_once ("./includes/_connect.php");

    $SQL = "CALL studentProfileUser(1)"; //Calls the routine in the database which grabs all the data of a user

    $result = mysqli_query($db_connect, $SQL);

    $user = mysqli_fetch_assoc($result);
?>