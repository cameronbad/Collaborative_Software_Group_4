<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="registerBody">
    <section class="registerSection">
        <!--CREATES FORM AREA -->
        <form class="registerForm">
            <img class="registerLogo" src="./Images/EduTestLogo.png" alt="logo">
            <h1 class="registerTitle">Register</h1>
            <!--CREATES INPUTS FOR USER DATA -->
            <div class="registerInput">
                <label id="reglabel">Student Number</label>
                <input type="text" id="studentID" name="studentNum" placeholder="Enter student number...">
            </div>
            <div class="registerInput">
                <label id="registerLabel">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="Enter first name...">
            </div>
            <div class="registerInput">
                <label id="registerLabel">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Enter last name...">
            </div>
            <div class="registerInput">
                <label>Email</label>
                <input type="email" id="emailInput" name="emailInput" placeholder="Enter email...">
            </div>
            <div class="registerInput">
                <label id="registerLabel">Username</label>
                <input type="text" id="userInput" name="userInput" placeholder="Enter username...">
            </div>
            <div class="registerInput">
                <label id="registerLabel">Password</label>
                <input type="password" id="passInput" name="passInput" placeholder="Enter password...">
            </div>
            <div class="registerInput">
                <label id="registrationLabel">Confirm Password</label>
                <input type="password" id="confirmPassInput" name="confirmPassInput" placeholder="Confirm password...">
            </div>
            <div class="registerInput">
                <label>Course</label>
                <select id="courseInput" name="courseInput">
                    <option value="1">Computer Science</option>
                    <option value="2">Information Technology</option>
                    <option value="3">Software Engineering</option>
                    <option value="4">Computer Engineering</option>
                </select>
            </div>
            <button class="registerButton" type="submit">Register</button>
            <!--CREATES LINK TO LOGIN PAGE -->
            <div class="loginStudent">
                <p>Already have an account?
                    <a href="login.php">Login</a>
                </p>
            </div>
        </form>
    </section>
</body>

</html>