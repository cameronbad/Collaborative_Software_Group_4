<?php
session_start();
include_once("./includes/_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $studentNum = $firstName = $lastName = $email = $courseID = $username = $password = "";

    // Function for validating and sanitizing the input data
    function validate($data) {
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

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the SQL statement to insert user data into the database
    $sql = "INSERT INTO user (studentNumber, firstName, lastName, email, courseID, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db_connect, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $studentNum, $firstName, $lastName, $email, $courseID, $username, $hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($db_connect);
        header("Location: login.php"); // Redirect to login page after successful registration
        exit();
    } else {
        echo "Error: " . mysqli_error($db_connect);
    }
}