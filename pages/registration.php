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
        <form class="registerForm" action="./functionality/registerStudent.php" method="post">
            <img class="registerLogo" src="./Images/EduTestLogo.png" alt="logo">
            <h1 class="registerTitle">Register</h1>
            <!--CREATES INPUTS FOR USER DATA -->
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Student Number" id="studentNum"
                        name="studentNum" label="Student Number">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="First Name" id="firstName" name="firstName" label="First name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last Name" id="lastName" name="lastName" label="Last Name">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" label="Email">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <select class="form-select" id="course" name="course" aria-label="Course">
                        <option selected>Course:</option>
                        <?php
                        include './includes/_connect.php';
                        $sql = "SELECT * FROM course";
                        $result = mysqli_query($db_connect, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['courseID'] . "'>" . $row['courseName'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Username" id="username" name="username" label="Username">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" label="Password">
                </div>
                <div class="col">
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confPass" name="confPass"
                        label="Confirm Password">
                </div>
            </div>
            <button class="registerButton" type="submit">Register</button>
            <!--CREATES LINK TO LOGIN PAGE -->
            <div class="loginStudent">
                <p>Already have an account?
                    <a href="login">Login</a>
                </p>
            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>