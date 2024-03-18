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
        $data = $db_connect->real_escape_string($data);
        return $data;
    }

    $uname = validate($_POST["userInput"], $db_connect);
    $pass = $_POST["passInput"];

    //replace underscore with space in error message

    if (empty($uname)) {
        header("Location: ../loginUsername_is_required");
        exit();
    } else if (empty($pass)) {
        header("Location: ../loginPassword_is_required");
        exit();
    } else {
        $sql = "SELECT * FROM `user` WHERE `user`.`username`=?";
        $stmt = $db_connect->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && password_verify($pass, $row['password']) && $row['accountState'] == 1) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['courseID'] = $row['courseID'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['accessLevel'] = $row['accessLevel'];
                $_SESSION['loginAttempts'] = 0; // Reset login attempts counter
                unset($_SESSION['blockedTime']); // Remove block time
                //Gets the current date and time
                $date = date('Y-m-d H:i:s');
                //Inserts the date and time into the database
                $SQL = "UPDATE `user` SET `lastLogin` = $date WHERE `user`.`username` = ?";
                $stmt = $db_connect->prepare($SQL);
                $stmt->bind_param("s", $uname);
                $stmt->execute();
                header("Location: ../testDashboard");
                exit();
            } else {
                $_SESSION['loginAttempts']++; // Increment login attempts counter
                if ($_SESSION['loginAttempts'] >= $maxLoginAttempts) {
                    $_SESSION['blockedTime'] = time() + $blockedTime; // Set block time
                    header("Location: ../loginIncorrect_Username_or_Password._You_have_been_blocked.");
                    exit();
                } else {
                    $attemptsLeft = $maxLoginAttempts - $_SESSION['loginAttempts'];
                    header("Location: ../loginIncorrect_Username_or_Password_or_your_account_has_been_Disabled._$attemptsLeft-attempts_left.");
                    exit();
                }
            }
        } else {
            $_SESSION['loginAttempts']++; // Increment login attempts counter
            if ($_SESSION['loginAttempts'] >= $maxLoginAttempts) {
                $_SESSION['blockedTime'] = time() + $blockedTime; // Set block time
                header("Location: ../loginIncorrect_Username_or_Password._You_have_been_blocked.");
                exit();
            } else {
                $attemptsLeft = $maxLoginAttempts - $_SESSION['loginAttempts'];
                header("Location: ../loginIncorrect_Username_or_Password_or_your_account_has_been_Disabled._$attemptsLeft-attempts_left.");
                exit();
            }
        }
    }

} else {
    header("Location: /login");
    exit();
}