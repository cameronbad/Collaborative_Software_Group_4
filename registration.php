<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="registerBody">
    <section class="registerSection">
        <!-- CREATES FORM AREA -->
        <form class="registerForm"> 
            <img class="registerLogo" src="./Images/EduTestLogo.png" alt="logo">
            <h1 class="registerTitle">Register</h1>
            <!--CREATES INPUTS FOR USER DATA -->
            <!-- <div class="registerInput">
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
            </div> -->

            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Student Number" aria-label="Student Number">
                </div>
            </div>
            <div class="row mb-3">
            <div class="col">
                    <input type="text" class="form-control" placeholder="First Name" aria-label="First name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="email" class="form-control" placeholder="Email" aria-label="Email">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                </div>
                <div class="col">
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password">
                </div>
                <div class="col">
                    <select class="form-select" aria-label="Course">
                        <option selected>Course</option>
                        <option value="1">Computer Science</option>
                        <option value="2">Information Technology</option>
                        <option value="3">Software Engineering</option>
                        <option value="4">Computer Engineering</option>
                    </select>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>