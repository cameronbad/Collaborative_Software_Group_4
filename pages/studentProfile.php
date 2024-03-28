<?php include_once("functionality/loginCheck.php") ?> <!-- Checks if the user has logged in -->
<?php include_once("functionality/authCheck.php") ?> <!-- Checks if the user is of the correct access level -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../Images/EduTestLogo.png" type="image/x-icon">
    <link href="../style.css" rel="stylesheet">
</head>
<body class="m-0 p-0" id="studentProfileBody">

<?php include('./includes/studentInfo.php');?> <!-- Grabs a students data -->

<div class="container p-5">
    <div class="studentProfileBack">
        <a type="submit" class="btn btn-danger" href="g4-csd.remote.ac/studentDisplay" id="profileBackBtn">Back</a> <!-- Returns the user to the student managment table-->
    </div>
    <div class="container row" id="studentProfileMain">
        <div class="col">
            <div>
            <?php
                $hash = md5(strtolower(trim($email)));
                echo "<img src='http://gravatar.com/avatar/$hash?size=400&d=identicon' class='profilePicture'>";
            ?>
            </div>
            <div>
                <p>Profile pictures can be set here: <a href="https://gravatar.com">https://gravatar.com</a></p>
            </div>
        </div>
        <div class="col">
            <form id="studentProfileForm" name="studentProfileForm">  <!-- Form displays students data -->
                <div class="row">
                    <div class="mb-3 col">
                        <label for="studentProfileID" class="form-label">ID</label>
                        <input type="text" class="form-control" id="studentProfileID" name="studentProfileID" value="<?php echo $userID ?>" readonly>
                    </div>
                    <div class="mb-3 col">
                        <label for="studentProfileUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="studentProfileUsername" name="studentProfileUsername" value="<?php echo $username ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="studentProfileName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="studentProfileName" name="studentProfileName" value="<?php echo $firstName ?>">
                    </div>
                    <div class="mb-3 col">
                        <label for="studentProfileName" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="studentProfileSurname" name="studentProfileSurname" value="<?php echo $lastName ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="studentProfileEmail" class="form-label">Email</label>
                    <input type="text" class="form-control" id="studentProfileEmail" name="studentProfileEmail" value="<?php echo $email ?>">
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="studentProfileNumber" class="form-label">Student Number</label>
                        <input type="text" class="form-control" id="studentProfileNumber" value="<?php echo $studentNumber ?>" readonly>
                    </div>
                    <div class="mb-3 col">
                        <label for="studentProfileCourse" class="form-label">Course</label>
                        <input type="text" class="form-control" id="studentProfileCourse" value="<?php include_once("./includes/accountCourseDisplay.php") ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="studentProfileState" class="form-label">Account State</label>
                        <input type="text" class="form-control" id="studentProfileState" value="<?php include_once("./includes/accountStateDisplay.php") ?>" readonly><!-- Dispalys if user is actived or disabled -->
                    </div>
                    <div class="mb-3 col">
                        <label for="studentProfileLogin" class="form-label">Last Login</label>
                        <input type="text" class="form-control" id="studentProfileLogin" value="<?php echo $lastLogin ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary profileBtn">Save</button> <!-- For editing students -->
                    </div>
                    <div class="col">
                        <?php 
                            if($accountState == 0 ||  $accountState == NULL){
                                echo "<button type='button' class='btn btn-primary profileBtn' data-bs-toggle='modal' data-bs-target='#approveModal'>Approve</button>"; //Will approve their account
                            }
                            else{
                                echo "<button type='button' class='btn btn-primary profileBtn' data-bs-toggle='modal' data-bs-target='#disableModal'>Disable</button>"; //Will disable their account
                            }
                        ?>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary profileBtn" data-bs-toggle="modal" data-bs-target="#terminateModal">Terminate</button> <!-- For terminating students -->
                    </div>
                </div>
                <div class="row pt-1">
                    <div class="col">
                        <button type="button" class="btn btn-primary profileBtn" data-bs-toggle="modal" data-bs-target="#assignClassModal">Assign Class</button> <!-- For asigning classes for students -->
                    </div>
                </div>
            </form>
            </div>
        <div>
        </div>
    </div>
    
    <?php include_once("includes/disableAccountModal.php"); ?> <!-- Displays modal for disabling accounts -->
    <?php include_once("includes/approveAccountModal.php"); ?> <!-- Displays modal for approving accounts -->
    <?php include_once("includes/terminateAccountModal.php"); ?> <!-- Displays modal for terminating accounts -->
    <?php include_once("includes/assignClassModal.php"); ?> <!-- Displays modal for assigning classes -->
 
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$('#studentProfileForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "../functionality/editProfile.php",
                method: "POST",
                data: $('#studentProfileForm').serialize(),
                success: function(data) {
                    location.reload();
                }
            })
        });

$('#disableBtnModal').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "../disableAccount/",
                method: "GET",
                data: ({sID: <?php echo $userID?>}),
                success: function(data) {
                    location.reload();
                }
            })
        });

$('#approveBtnModal').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "../approveAccount/",
                method: "GET",
                data: ({sID: <?php echo $userID?>}),
                success: function(data) {
                    location.reload();
                }
            })
        });

        $('#terminateBtnModal').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "../terminateAccount/",
                method: "GET",
                data: ({sID: <?php echo $userID?>}),
                success: function(data) {
                    location.replace("../studentDisplay");
                }
            })
        });

        $('#classAssignForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "../functionality/assignClass.php",
                method: "POST",
                data: $('#classAssignForm').serialize(),
                success: function(data) {
                    alert(data);
                    location.reload();
                }
            })
        });
</script>