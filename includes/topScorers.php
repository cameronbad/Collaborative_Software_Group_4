<?php

require_once ("_connect.php");

$filter = mysqli_real_escape_string($db_connect, $_POST['classFilters']);

$SQL = "CALL topScoringStudents($filter)"; //Calls the procedure

$result = mysqli_query($db_connect, $SQL);

$Place = 0; //Stores the placement number

$BarNum = 100; //Used to calcualte the progress bar width
$BarNumDiff = 0;

while($row = mysqli_fetch_assoc($result)){ //Loops through the query result

    if($Place > 0){ //Calculates BarNum and doesnt run on the first loop
    $BarNum = $BarNum - ($BarNumDiff - $row['resultTotal']);
    }

    $Place++;

    echo "<tr>";
    echo "<td>" . $Place . "</td>";
    echo "<td>" . $row['username'] . "</td>";?> 

    <td> 
        <div class="progress"><!-- Animated progress bar displaying student's score -->
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $BarNum ?>%"><?php echo $row['resultTotal'] ?></div>
        </div>
    </td><?php

    echo "</tr>";

    $BarNumDiff =  $row['resultTotal']; //Stores previouse score
}
?>