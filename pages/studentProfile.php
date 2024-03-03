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

<?php include('./includes/navbar.php');?> <!-- Grabs the navbar code and displays it on the student management page -->

<div class="container p-5">
    <div class="studentProfileBack">
        <a type="submit" class="btn btn-danger" href="/Collaborative_Software_Group_4/studentDisplay">Back</a> <!-- Returns the user to the student managment table-->
    </div>
    <div class="container" id="studentProfileMain">
        <div class="studentProfileLeft">
            <div>
                <img alt="Profile Picture"> <!-- May remove but will display a profile picture if implemented-->
            </div>
            <div>
                <p>stuff</p>
            </div>
        </div>
            <div class="studentProfileRight">

            <?php include('./includes/studentInfo.php');?> <!-- Grabs a students data -->

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
                <button type="submit" class="btn btn-primary">Save</button> <!-- For editing students -->
                <?php 
                if($accountState == 0 ||  $accountState == NULL){
                    echo "<button type='button' class='btn btn-primary' id='approveBtn' name='approveBtn' data-bs-toggle='modal' data-bs-target='#approveModal'>Approve</button>"; //Will approve their account
                }
                else{
                    echo "<button type='button' class='btn btn-primary' id='disableBtn' name='disableBtn' data-bs-toggle='modal' data-bs-target='#disableModal'>Disable</button>"; //Will disable their account
                }
                ?>
            </form>
            </div>
        <div>
        </div>
    </div>
    
    <?php include_once("includes/disableAccountModal.php"); ?> <!-- Displays modal for disabling accounts -->
    <?php include_once("includes/approveAccountModal.php"); ?> <!-- Displays modal for approving accounts -->
 
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
</script>