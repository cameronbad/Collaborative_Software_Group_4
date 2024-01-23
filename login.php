<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="loginBody">
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
            <button>Login</button>
            <!--CREATES LINK TO REGISTER PAGE -->
            <div class="registerStudent">
                <p>Don't have an account?
                    <a href="#">Register</a>
                </p>
            </div>
        </form>
    </section>
</body>
</html>