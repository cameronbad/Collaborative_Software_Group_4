<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="loginBody">

    <?php
    require('includes/_connect.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query = "SELECT * FROM `user` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: index.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
        ?>
        <section class="loginSection">
            <!--CREATES FORM AREA -->
            <form>
                <img src="./Images/EduTestLogo.png" alt="logo" style="max-width:150px;height:150px;margin-left:18%;">
                <h1>Login</h1>
                <!--CREATES USERNAME AND PASSWORD INPUTS -->
                <div class="loginInput">
                    <label>Username</label>
                    <input type="text" id="usernameInput" placeholder="Enter username..." required>
                </div>
                <div class="loginInput">
                    <label>Password</label>
                    <input type="password" id="passwordInput" placeholder="Enter password..." required>
                </div>
                <input type="submit" value="Login" name="submit" class="login-button" />
                <!--CREATES LINK TO REGISTER PAGE -->
                <div class="registerStudent">
                    <p>Don't have an account?
                        <a href="#">Register</a>
                    </p>
                </div>
            </form>
            <?php
    }
    ?>
    </section>
</body>

</html>