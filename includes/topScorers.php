<?php

// Hides strict standard output
error_reporting(error_reporting() & ~E_STRICT & ~E_DEPRECATED); 

require_once("_connect.php");
require_once("_functions.php");

while($db_connect->next_result()){;} //Fixes Unsynch Error

if(isset($_POST['classFilters'])){ //Checks if its a filter or a onload up
    $filter = $db_connect->real_escape_string($_POST['classFilters']);
}
else{
    $filter = getSubjectID($db_connect); //Calls function which grabs the subject ID
}

$stmt = $db_connect->prepare("CALL topScoringStudents(?)"); //Prepares the statement
$stmt->bind_param("i", $filter); //Binds the parameter

$stmt->execute(); //Runs the query

$stmt->store_result();
$stmt->bind_result($username, $resultTotal); //Stores the result into a variable

$Place = 0; //Stores the placement number

$BarNum = 100; //Used to calculate the progress bar width
$BarNumDiff = 0;

while($stmt->fetch()){ //Loops through the query result

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

$stmt->close(); //Closes the stmt
$db_connect->close();

?>