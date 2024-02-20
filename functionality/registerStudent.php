<?php
session_start();
include_once("./includes/_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $studentNum = $firstName = $lastName = $email = $courseID = $username = $password = "";

    // Function for validating and sanitizing the input data
    function validate($data)
    {
        include_once("./includes/_connect.php");
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($db_connect, $data);
        return $data;
    }

    // Validate and sanitize input data
    $studentNum = validate($_POST["studentNum"]);
    $firstName = validate($_POST["firstName"]);
    $lastName = validate($_POST["lastName"]);
    $email = validate($_POST["email"]);
    $courseID = validate($_POST["courseID"]);
    $username = validate($_POST["username"]);
    $password = validate($_POST["password"]);

    //Checks that the password inputs match
    if ($_POST["password"] != $_POST["confirmPassInput"]) {
        header("Location: registerStudent.php?error=Passwords do not match");
        exit();
    }

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Sends the data in a message to the lecturers for approval where they press the approval button
    $message = "Student Number: " . $studentNum . "\nFirst Name: " . $firstName . "\nLast Name: " . $lastName . "\nEmail: " . $email . "\nCourse ID: " . $courseID . "\nUsername: " . $username;
    mail("ws314697@weston.ac.uk", "Student Registration Approval", $message);

    // Should the user be approved, the data will be inserted into the database
    // Prepare and execute the SQL statement to insert user data into the database
    $sql = "INSERT INTO user (studentNumber, firstName, lastName, email, courseID, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db_connect, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $studentNum, $firstName, $lastName, $email, $courseID, $username, $hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($db_connect);
        header("Location: login.php"); // Redirect to login page after successful registration
        //Send email to the user stating that their account has been successfully created
        $message = "Hello " . $firstName . " " . $lastName . ",\n\nYour account has been successfully created. You can now login to the system using the following credentials:\n\nUsername: " . $username . "\nPassword: " . $password . "\n\nKind regards,\n\nEduTestPro Team";
        mail($email, "Account Created", $message);
        exit();
    } else {
        echo "Error: " . mysqli_error($db_connect);
    }
}