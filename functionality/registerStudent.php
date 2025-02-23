<?php
session_start();
include_once ("../includes/_connect.php");

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
            $data = $db_connect->real_escape_string($data);
        }
        return $data;
    }

    // Validate and sanitize input data
    if ($db_connect === false) {
        if (!$db_connect) {
            die ("Database connection error: " . mysqli_connect_error());
        }
    }

    //empty fields
    if (empty($_POST["studentNum"]) || empty($_POST["firstName"]) || empty($_POST["lastName"]) || empty($_POST["email"]) || empty($_POST["course"]) || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confPass"])) {
        echo "Please fill in all fields.";
        header("refresh:2; url=../register");
        exit();
    }

    // Validate and sanitize input data
    $studentNum = isset ($_POST["studentNum"]) ? validate($_POST["studentNum"], $db_connect) : "";
    $firstName = isset ($_POST["firstName"]) ? validate($_POST["firstName"], $db_connect) : "";
    $lastName = isset ($_POST["lastName"]) ? validate($_POST["lastName"], $db_connect) : "";
    $email = isset ($_POST["email"]) ? validate($_POST["email"], $db_connect) : "";
    $courseID = isset ($_POST["course"]) ? validate($_POST["course"], $db_connect) : "";
    $username = isset ($_POST["username"]) ? validate($_POST["username"], $db_connect) : "";
    $password = isset ($_POST["password"]) ? validate($_POST["password"], $db_connect) : "";
    $confirmPassInput = isset ($_POST["confPass"]) ? validate($_POST["confPass"], $db_connect) : "";

    // Check if the password and confirm password match
    if ($password != $confirmPassInput) {
        //redirect to the registration page after 2 seconds once echoing the error message
        echo "Passwords do not match. Please try again.";
        header("refresh:2; url=../register");
        exit();
    }


    $options = [
        'cost' => 12,
    ];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    // Sends the data in a message to the lecturers for approval where they press the approval button
    $message = "Student Number: " . $studentNum . "\nFirst Name: " . $firstName . "\nLast Name: " . $lastName . "\nEmail: " . $email . "\nCourse ID: " . $courseID . "\nUsername: " . $username;
    $message = wordwrap($message, 70);
    mail("max04082003@gmail.com", "Student Registration Approval", $message);

    // Should the user be approved, the data will be inserted into the database
    // Prepare and execute the SQL statement to insert user data into the database
    $sql = "CALL registerStudent(?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $db_connect->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssii", $username, $firstName, $lastName, $email, $hashed_password, $studentNum, $courseID, $accessLevel);
        $stmt->execute();
        $stmt->close();
        $db_connect->close();
        header("Location: ../login"); // Redirect to login page after successful registration
        //Send email to the user stating that their account has been successfully created
        $messageStudent = "Hello " . $firstName . " " . $lastName . ",\n\nYour account has been successfully created. You can now login to the system using the following credentials:\n\nUsername: " . $username . "\nPassword: " . $password . "\n\nKind regards,\n\nEduTestPro Team";
        mail($email, "Account Created", $messageStudent);
        exit();
    } else {
        echo "Error: " . mysqli_error($db_connect);
    }
}