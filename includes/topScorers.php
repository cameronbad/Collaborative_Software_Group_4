<?php
require_once ("_connect.php");

$SQL = "CALL topScoringStudents();"; //Calls the procedure

$result = mysqli_query($db_connect, $SQL);

while($row = mysqli_fetch_assoc($result)){ //Loops through the query results
    echo $row['testID']."<br/>";
    echo $row['testName']."<br/>";
    echo $row['userID']."<br/>";
    echo $row['username']."<br/>";
    echo $row['resultTotal']."<br/>";
}
?>