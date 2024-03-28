<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.datatables.net/v/bs/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/r-2.5.0/datatables.min.css" rel="stylesheet">
  <link href="
https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css
" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/r-2.5.0/datatables.min.js"></script>




  <link href="style.css" rel="stylesheet">
  <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
</head>

<body>
  <?php include_once("includes/navbar.php"); ?>
  <?php include_once("functionality/loginCheck.php") ?> <!-- Checks if the user has logged in -->
  <?php include_once("functionality/authCheck.php") ?> <!-- Checks if the user is of the correct access level -->
  <main>
    <section class="container">

      <h1>Lecturer management dashboard</h1>
      <p>Use the page below to manage users</p>


      <!-- Button to trigger modal -->
      <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#createModal">
        + Add User
      </button>
      <br>



      <!-- ALL OF THIS IS OBSELETE BUT DELETING IT BREAKS IT FOR SOME REASON SO I'M LEAVING IT IN -->
      <?php
      include_once("./includes/_connect.php");
      //DELETE 
      if (isset($_POST["DcourseID"])) {
      ?>
        <div class="" role="alert">
          <?php
          echo "" . $_POST['DcourseID'];
          ?>
        </div>
      <?php

        $courseID = $_POST['DcourseID'];
        $query = "DELETE FROM 'subject' WHERE `subject`.`subjectID` = $courseID";
        echo $run;
        $run = mysqli_query($db_connect, $query);
      }


      

      /////////////////////////////////RELEVANT CODE/////////////////////////////////

      if (isset($_POST["userID"]) && isset($_POST["username"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["courseID"])) {
        $userName = $_POST["username"];
        $userID = $_POST["userID"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $courseID = $_POST["courseID"];

        $query = "UPDATE `user` SET `username` = '$userName',`firstName` = '$firstName',`lastName` = '$lastName',`email` = '$email' WHERE `userID` = '$userID';";
        $run = mysqli_query($db_connect, $query);


        if ($run) {
        ?>
          <div class="alert alert-success" role="alert">
            User <?php echo $userName ?> has been updated.
          </div>
        <?php
        } else {
        ?>
          <div class="alert alert-danger" role="alert">
            Failed to update <?php echo $userName ?>.
          </div>
      <?php
        }
      }
       //Selecting Database Entries
       $query = "SELECT `userID`, `username`, `firstName`, `lastName`, `accountState`, `email` FROM `user` WHERE `accessLevel` = 2"; 
      $run = mysqli_query($db_connect, $query);
      ?>

      <!--Table-->
      <table id="dataTable" class=" table table-bordered table-striped pt-3">
        <thead>
          <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($result = mysqli_fetch_assoc($run)) { ?>
            <tr>
              <td><?php echo $result["username"] ?></td>
              <td><?php echo $result["firstName"] ?></td>
              <td><?php echo $result["lastName"] ?></td>
              <td><?php echo $result["email"] ?></td>
              <td><a href="" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-username="<?php echo $result["username"] ?>" data-bs-id="<?php echo $result["userID"] ?>" data-bs-firstname="<?php echo $result["firstName"] ?>" data-bs-lastname="<?php echo $result["lastName"] ?>" data-bs-email="<?php echo $result["email"] ?>"> <i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            </tr>

          <?php } ?>

        </tbody>
      </table>

<!--Modals-->
<!--Create Modal-->
      <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="./includes/lecturerCreate.php">
                <div class="modal-body">
                    <p>Create a new User</p>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" id="username" placeholder="Username" required>
                        <input type="hidden" name="userID" class="form-control userID" id="userID">
                    </div>

                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input name="firstName" type="text" class="form-control" id="firstName" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Last Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                    </div>

                    <div class="mb-3">
                  <label for="select" class="form-label">Course</label>
                  <select name="addCourse" class="form-select" id="select" required aria-label="Default select example">
                    <option selected>Please select a course</option>
                    <?php
                    $query = "SELECT* from `course`";
                    $run = mysqli_query($db_connect, $query);
                    while ($course = mysqli_fetch_assoc($run)) {
                      echo "<option value='" . $course["courseID"] . "'>" . $course["courseName"] . "</option>";
                    }
                    ?>
                  </select>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal  -->

  <div class="modal fade" id="editModal<?php ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="./includes/lecturerEdit.php">
                <div class="modal-body">

                <div class="mb-3">   
                  <label for="username" class="col-form-label">Lecturer Username:</label>
                  <input type="text" name="username" class="form-control username" id="username">
                  <input type="hidden" name="userID" class="form-control userID" id="userID">
                  </div>

                <div class="mb-3">   
                  <label for="firstName" class="col-form-label">Lecturer First Name:</label>
                  <input type="text" name="firstName" class="form-control firstName" id="firstName">
                  </div>

                  <div class="mb-3">   
                  <label for="lastName" class="col-form-label">Lecturer Surname:</label>
                  <input type="text" name="lastName" class="form-control lastName" id="lastName">
                  </div>

                  <div class="mb-3">   
                  <label for="email" class="col-form-label">Email Address:</label>
                  <input type="email" name="email" class="form-control email" id="email">
                  </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
      <!-- /Edit Modal-->
    </section>
  </main>

</body>
<script>
    let table = new DataTable('#dataTable');

    // Edit modal
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        const username = button.getAttribute('data-bs-username');
        const firstname = button.getAttribute('data-bs-firstName');
        const lastname = button.getAttribute('data-bs-lastName');
        const email = button.getAttribute('data-bs-email');
        const id = button.getAttribute('data-bs-id');
        const courseID = button.getAttribute('data-bs-courseID'); 

        const modalTitle = editModal.querySelector('.modal-title');
        const modalUserInput = editModal.querySelector('.modal-body .username');
        const modalUIDInput = editModal.querySelector('.modal-body .userID');
        const modalCourseIDInput = editModal.querySelector('.modal-body .courseID'); 

        modalTitle.textContent = `Editing User: ${username}`;
        modalUserInput.value = username;
        modalUIDInput.value = id;
        modalCourseIDInput.value = courseID; 
    });
</script>


</html>
