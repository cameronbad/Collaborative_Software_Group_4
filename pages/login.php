<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="loginBody">
    <section class="loginSection">
        <!--CREATES FORM AREA -->
        <form class="loginForm" id="loginForm">
            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
            <img class="loginLogo" src="./Images/EduTestLogo.png" alt="logo">
            <h1 class="loginTitle">Login</h1>
            <!--CREATES ERROR MESSAGE -->
            <p class="error" id="errorMessage" style="display:none;"></p>
            <!--CREATES USERNAME AND PASSWORD INPUTS -->
            <div class="loginInput">
                <label>Username</label>
                <input type="text" id="userInput" name="userInput" placeholder="Enter username...">
            </div>
            <div class="loginInput">
                <label>Password</label>
                <input type="password" id="passInput" name="passInput" placeholder="Enter password...">
            </div>
            <button class="loginButton" type="submit">Login</button>
            <!--CREATES LINK TO REGISTER PAGE -->
            <div class="registerStudent">
                <p>Don't have an account?
                    <a href="register">Register</a>
                </p>
            </div>
        </form>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lfv350pAAAAAKiom8ecSe4eYyinCRs1mdRWhulw"></script>
    <script>
        $('#loginForm').submit(function (e) {
            e.preventDefault();
            grecaptcha.ready(function () {
                grecaptcha.execute('6Lfv350pAAAAAKiom8ecSe4eYyinCRs1mdRWhulw',
                    { action: 'create_comment' }).then(function (token) {
                        var Username = $('#userInput').val();
                        var Password = $('#passInput').val();
                        $('#g-recaptcha-response').val(token);

                        $.ajax({
                            type: 'POST',
                            url: './functionality/intoDashboard.php',
                            data: {
                                token: $('#g-recaptcha-response').val(),
                                Username: Username,
                                Password: Password,
                            },
                            success: function (data) {
                                // Handle success response here
                                if (data.trim() === 'success1') {
                                    window.location.href = './testDashboard';
                                } else if (data.trim() === 'success2') {
                                    window.location.href = './studentDisplay';
                                } else if (data.trim() === 'success3') {
                                    window.location.href = './adminDashboard';
                                } else {
                                    $('#errorMessage').html(data);
                                    $('#errorMessage').show();
                                }
                            }
                        }); // <-- Closing bracket for $.ajax() function
                    });
            });
        });
    </script>
</body>

</html>