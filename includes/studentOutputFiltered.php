<?php

require_once ("_connect.php");

$filter = mysqli_real_escape_string($db_connect, $_POST['studentFilters']);

$SQL = "CALL allStudents($filter)";

$result = mysqli_query($db_connect, $SQL);

while($row = mysqli_fetch_assoc($result)){ //Loops through the query result

    echo "<tr>";
    echo "<th>" . $row['studentNumber'] . "</th>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['lastLogin'] . "</td>";
    ?>
    <td>
        <a class="btn btn-secondary" id="viewStudentBtn" name="viewStudentBtn" href="./studentProfile/?studentID=<?php echo $row['userID']?>">Edit</a>
    </td>
    <?php
    echo "</tr>";

}

?>
