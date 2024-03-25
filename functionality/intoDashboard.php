<?php
session_start();

// Include database connection
include ('../includes/_connect.php');

// Define maximum login attempts and lockout time (in minutes)
$maxAttempts = 3;
$lockoutTime = 10;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if user is currently locked out
    if (isset ($_SESSION['lockout']) && $_SESSION['lockout'] > time()) {
        echo "You have been temporarily locked out due to multiple failed login attempts. Please try again later.";
        exit();
    }

    // Google reCAPTCHA secret key
    $secretKey = '6Lfv350pAAAAABSLfJUefNHfjqanZI1aPcuFab86';

    // Verify reCAPTCHA response
    $responseToken = $_POST['token'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $responseToken
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captchaSuccess = json_decode($verify)->success;

    if ($captchaSuccess) {
        // Sanitize user input to prevent SQL injection
        $username = $db_connect->real_escape_string($_POST['Username']);
        $password = $_POST['Password'];

        // Query to fetch user data
        $sql = "CALL loginUser(?);";
        $stmt = $db_connect->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        //check that there are no empty fields
        if (empty($username) || empty($password)) {
            echo "Please fill in all fields.";
            header("refresh:2; url=../login");
            exit();
        }

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify password using bcrypt
            if (password_verify($password, $row['password'])) {
                // Authentication successful
                $_SESSION['username'] = $row['username'];
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['accessLevel'] = $row['accessLevel'];
                $_SESSION['courseID'] = $row['courseID'];
                $_SESSION['email'] = $row['email'];
                // Reset login attempts
                unset($_SESSION['login_attempts']);
                //Check account status
                if ($row['accountState'] == 0) {
                    echo "Your account has been disabled. Please contact the administrator.";
                    exit();
                }
                // Update lastLogin time
                $currentTime = date('Y-m-d H:i:s');
                $updateSql = "CALL setLastLogin(?, ?);";
                $stmt = $db_connect->prepare($updateSql);
                $stmt->bind_param("ss", $currentTime, $username);
                $stmt->execute();
                $stmt->close();

                // Redirect user based on access level
                if ($_SESSION['accessLevel'] == 1) {
                    die("success1");
                } elseif ($_SESSION['accessLevel'] == 2) {
                    die("success2");
                } elseif ($_SESSION['accessLevel'] == 3) {
                    die("success3");
                } else {
                    header("Location: /login");
                    exit();
                }
            } else {
                // Invalid password
                handleInvalidLogin();
            }
        } else {
            // User not found
            handleInvalidLogin();
        }
    } else {
        // reCAPTCHA verification failed
        echo "reCAPTCHA verification failed. Please try again.";
        exit();
    }
}

function handleInvalidLogin()
{
    // Increment login attempts
    $_SESSION['login_attempts'] = isset ($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;

    // Check if maximum login attempts reached
    global $maxAttempts;
    if ($_SESSION['login_attempts'] >= $maxAttempts) {
        // Set lockout time
        global $lockoutTime;
        $_SESSION['lockout'] = time() + ($lockoutTime * 60); // Convert lockout time to seconds

        echo "You have exceeded the maximum number of login attempts. Please try again later.";
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
        exit();
    }
}