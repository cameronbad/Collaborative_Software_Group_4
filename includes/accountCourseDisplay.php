<?php
    require ("_connect.php");

    $cID = mysqli_real_escape_string($db_connect, $user['courseID']);

    $SQL = "CALL studentProfileCourse($cID)";

    $result = $db_connect->query($SQL);

    $row = mysqli_fetch_assoc($result);

    echo $row['courseName'];
 ?>