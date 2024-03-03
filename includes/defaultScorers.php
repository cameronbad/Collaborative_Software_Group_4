<?php

require_once ("_connect.php");

$course = $db_connect->real_escape_string(1);//add when session is fixed $_SESSION['courseID']

$stmt = $db_connect->prepare("CALL topScoringStudents(?)"); //Prepares the statement
$stmt->bind_param("i", $course); //Binds the parameter

$stmt->execute(); //Runs the query

$stmt->store_result();
$stmt->bind_result($username, $resultTotal); //Stores the result into a variable

$Place = 0; //Stores the placement number

$BarNum = 100; //Used to calcualte the progress bar width
$BarNumDiff = 0;

while($stmt->fetch()){  //Loops through the query result

    if($Place > 0){ //Calculates BarNum and doesnt run on the first loop
    $BarNum = $BarNum - ($BarNumDiff - $resultTotal);
    }

    $Place++;

    echo "<tr>";
    echo "<td>" . $Place . "</td>";
    echo "<td>" . $username . "</td>";?> 

    <td> 
        <div class="progress"><!-- Animated progress bar displaying student's score -->
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $BarNum ?>%"><?php echo $resultTotal ?></div>
        </div>
    </td><?php

    echo "</tr>";

    $BarNumDiff =  $resultTotal; //Stores previous score
}
?>