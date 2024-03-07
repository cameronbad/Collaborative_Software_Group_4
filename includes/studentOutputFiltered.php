<?php

require_once("_connect.php");

if(isset($_POST['studentFilters'])){ //Checks if its a filter or a onload up
    $filter = $db_connect->real_escape_string($_POST['studentFilters']);
}
else{
    $filter = $db_connect->real_escape_string($_SESSION['courseID']);
}


$stmt = $db_connect->prepare("CALL allStudents(?)"); //Prepares the statement
$stmt->bind_param("i", $filter); //Binds the parameter
$stmt->execute(); //Runs the query

$stmt->store_result();
$stmt->bind_result($studentNumber, $firstName, $lastName, $username, $email, $lastLogin, $userID); //Stores the result into a variable


while($stmt->fetch()){ //Loops through the query result

    echo "<tr>";
    echo "<th>" . $studentNumber . "</th>";
    echo "<td>" . $firstName . "</td>";
    echo "<td>" . $lastName . "</td>";
    echo "<td>" . $username . "</td>";
    echo "<td>" . $email . "</td>";
    echo "<td>" . $lastLogin . "</td>";
    ?>
    <td>
        <a class="btn btn-secondary" id="viewStudentBtn" name="viewStudentBtn" href="./studentProfile/?studentID=<?php echo $userID ?>">Edit</a>
    </td>
    <?php
    echo "</tr>";

}

$stmt->close();
$db_connect->close();

?>
