<?php @session_start(); ?>

<thead>
    <tr>
        <th>ID</th>
        <th>Test Name</th>
        <?php if ($_SESSION['accessLevel'] == '3') {echo '<th>Course</th>';}?> 
        <th>Subject</th>
        <th>Amount of Questions</th>
        <th>Assign</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>
    <?php
    include_once("_connect.php");

    //Get query for table
    if ($_SESSION['accessLevel'] == '3') { //If admin account
        $query = "SELECT `test`.*, `subject`.`subjectName`, `subject`.`courseID`, `course`.`courseName` FROM `test` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID` LEFT JOIN `course` ON `subject`.`courseID` = `course`.`courseID`" ; 
    } else { //If teacher account
        $query = "SELECT `test`.*, `subject`.`subjectName`, `subject`.`courseID` FROM `test` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID` WHERE `subject`.`courseID` = 1" ; //. $_SESSION["courseID"]
    }

    $run = $db_connect->query($query);
    while ($result = $run->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $result["testID"] . "</td>";
        echo "<td>" . $result["testName"] . "</td>";
        if ($_SESSION['accessLevel'] == '3') {echo "<td>" . $result["courseName"] . "</td>";}
        echo "<td>" . $result["subjectName"] . "</td>";
        echo "<td>" . $result["questionAmount"] . "</td>"; 
        echo "<td> <button type='button' class='btn btn-success' data-bs-tid='" . $result["testID"] . "' data-bs-cid='" . $result["courseID"] . "'data-bs-toggle='modal' data-bs-target='#assignModal'>Assign</button></td>";
        echo "<td> <button type='button' class='btn btn-primary' data-bs-tid='" . $result["testID"] . "'data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button></td>";
        echo "<td> <button type='button' class='btn btn-danger'  data-bs-tid='" . $result["testID"] . "'data-bs-toggle='modal' data-bs-target='#deleteModal'>Remove</button> </td>";
        echo "</tr>";
    }
    ?>
</tbody>