<?php
session_start();
include "../includes/_connect.php";

// Initialize login attempts counter and block time
if (!isset($_SESSION['loginAttempts'])) {
    $_SESSION['loginAttempts'] = 0;
}

if (!isset($_SESSION['blockedTime']) || $_SESSION['blockedTime'] <= time()) {
    $_SESSION['loginAttempts'] = 0; // Reset login attempts counter
    unset($_SESSION['blockedTime']); // Remove block time
}

// Define maximum login attempts and block duration
$maxLoginAttempts = 3;
$blockedTime = 30; // in seconds

if (isset($_POST['userInput']) && isset($_POST['passInput'])) {

    function validate($data, $db_connect)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = $db_connect->real_escape_string($db_connect, $data);
        return $data;
    }

    $uname = isset($_POST["username"]) ? validate($_POST["username"], $db_connect) : "";
    $pass = isset($_POST["password"]) ? validate($_POST["password"], $db_connect) : "";

    if (empty($uname)) {
        header("Location: ../loginUsername_is_required");
        exit();
    } else if (empty($pass)) {
        header("Location: ../loginPassword_is_required");
        exit();
    } else {
        $sql = "SELECT * FROM `user` WHERE `user`.`username`=? AND `user`.`password`=?";
        $stmt = mysqli_prepare($db_connect, $sql);

        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && password_verify($pass, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['courseID'] = $row['courseID'];
                $_SESSION['accessLevel'] = $row['accessLevel'];
                header("Location: /testDashboard");
                exit();
            } else {
                $_SESSION['loginAttempts']++; // Increment login attempts counter
                if ($_SESSION['loginAttempts'] >= $maxLoginAttempts) {
                    $_SESSION['blockedTime'] = time() + $blockedTime; // Set block time
                    header("Location: ../loginIncorrect_Username_or_Password.<br> You_have_been_blocked.");
                    exit();
                } else {
                    $attemptsLeft = $maxLoginAttempts - $_SESSION['loginAttempts'];
                    header("Location: ../loginIncorrect_Username_or_Password.<br> $attemptsLeft - attempts_left.");
                    exit();
                }
            }
        } else {
            $_SESSION['loginAttempts']++; // Increment login attempts counter
            if ($_SESSION['loginAttempts'] >= $maxLoginAttempts) {
                $_SESSION['blockedTime'] = time() + $blockedTime; // Set block time
                header("Location: ../loginIncorrect_Username_or_Password.<br> You_have_been_blocked.");
                exit();
            } else {
                $attemptsLeft = $maxLoginAttempts - $_SESSION['loginAttempts'];
                header("Location: ../loginIncorrect_Username_or_Password.<br> $attemptsLeft - attempts_left.");
                exit();
            }
        }
    }

} else {
    header("Location: /login");
    exit();
}