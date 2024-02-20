<?php
session_start();
include_once("./includes/_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $studentNum = $firstName = $lastName = $email = $courseID = $username = $password = $confirmPassInput = "";
    $accessLevel = 1; // Set the default access level to 1 (student)

    // Function for validating and sanitizing the input data
    function validate($data, $db_connect)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        if (is_object($db_connect)) { // Check if $db_connect is a valid MySQLi connection object
            $data = mysqli_real_escape_string($db_connect, $data);
        }
        return $data;
    }

    // Validate and sanitize input data
    if ($db_connect === false) {
        die("Database connection error: " . mysqli_connect_error());
    }

    // Validate and sanitize input data
    $studentNum = isset($_POST["studentNum"]) ? validate($_POST["studentNum"], $db_connect) : "";
    $firstName = isset($_POST["firstName"]) ? validate($_POST["firstName"], $db_connect) : "";
    $lastName = isset($_POST["lastName"]) ? validate($_POST["lastName"], $db_connect) : "";
    $email = isset($_POST["email"]) ? validate($_POST["email"], $db_connect) : "";
    $courseID = isset($_POST["course"]) ? validate($_POST["course"], $db_connect) : "";
    $username = isset($_POST["username"]) ? validate($_POST["username"], $db_connect) : "";
    $password = isset($_POST["password"]) ? validate($_POST["password"], $db_connect) : "";
    $confirmPassInput = isset($_POST["confPass"]) ? validate($_POST["confPass"], $db_connect) : "";

    //Checks that the password inputs match
    if ($_POST["password"] != $_POST["confPass"]) {
        header("Location: registerStudent.php?error=Passwords do not match");
        exit();
    }

    $options = [
        'cost' => 12,
    ];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    // Sends the data in a message to the lecturers for approval where they press the approval button
    $message = "Student Number: " . $studentNum . "\nFirst Name: " . $firstName . "\nLast Name: " . $lastName . "\nEmail: " . $email . "\nCourse ID: " . $courseID . "\nUsername: " . $username;
    mail("ws314697@weston.ac.uk", "Student Registration Approval", $message);

    // Should the user be approved, the data will be inserted into the database
    // Prepare and execute the SQL statement to insert user data into the database
    $sql = "INSERT INTO `user` (`username`, `firstName`, `lastName`, `email`, `password`, `studentNumber`, `courseID`, `accessLevel`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db_connect, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssii", $username, $firstName, $lastName, $email, $hashed_password, $studentNum, $courseID, $accessLevel);
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