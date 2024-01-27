<?php
require_once ("_connect.php");

$SQL = "CALL topScoringStudents();"; //Calls the procedure

$result = mysqli_query($db_connect, $SQL);

$Place = 0;

while($row = mysqli_fetch_assoc($result)){ //Loops through the query result
    $Place++;
    echo "<tr>";
    echo "<td>" . $Place . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['resultTotal'] . "</td>";
    echo "</tr>";
}
?>