<?php

require_once("_connect.php");

$SQL = "CALL allStudents();"; //Calls the procedure

$result = mysqli_query($db_connect, $SQL);

while($row = mysqli_fetch_assoc($result)){ //Loops through the query result

    echo "<tr>";
    echo "<td>" . $row['studentNumber'] . "</td>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['lastLogin'] . "</td>";
    echo "</tr>";

}

?>
