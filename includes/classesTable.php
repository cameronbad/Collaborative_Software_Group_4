<?php

include_once("_connect.php");

$SQL = "CALL allClasses()";

$result = $db_connect->query($SQL);

while($row = $result->fetch_assoc()){ //Displays class data
    $classID = $row['classID'];

    echo "<tr>";
    echo "<th>" . $row['classID'] . "</th>";
    echo "<td>" . $row['className'] . "</td>";
    echo "<td>" . $row['courseName'] . "</td>";
    echo "<td><button name='deleteClassBtn' type='submit' class='btn btn-danger deleteClassBtn' value='$classID'>Delete</button></td>"; //Displays buttons with ID values
    echo "</tr>";
}

?>