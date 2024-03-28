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

  <main>
    <section class="container">

      <h1>Lecturer management dashboard</h1>
      <p>Use the page below to manage users</p>
      <!-- ALL OF THIS IS OBSELETE BUT DELETING IT BREAKS IT FOR SOME REASON SO I'M LEAVING IT IN -->

      <!-- Button to trigger modal -->
      <!--<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#createModal">
        + Add User
      </button>-->
      <br>




      <?php
      include_once("includes/_connect.php");
      //DELETE SUBJECT
      if (isset($_POST["DcourseID"])) {
      ?>
        <div class="alert alert-warning" role="alert">

          <?php
          echo "You have deleted Subject ID " . $_POST['DcourseID'];
          ?>
        </div>
      <?php

        $courseID = $_POST['DcourseID'];
        $query = "DELETE FROM 'subject' WHERE `subject`.`subjectID` = $courseID";
        echo $run;
        $run = mysqli_query($db_connect, $query);
      }

      if (isset($_POST["addSubject"]) && isset($_POST["addCourse"])) {
        $addCourse = $_POST["addSubject"];
        $addSubject = $_POST["addCourse"];

        $query = "INSERT INTO `subject` (`subjectID`, `courseID`, `subjectName`) VALUES (NULL, '$addSubject','$addCourse');";
        // echo $query;
        $run = mysqli_query($db_connect, $query);

      ?>
        <div class="alert alert-success" role="alert">
          New course <?php echo $addCourse ?> has been added.
        </div>
        <?php

            
      }

      /////////////////////////////////RELEVANT CODE/////////////////////////////////

      if (isset($_POST["userID"]) && isset($_POST["username"]) && isset($_POST["firstName"]) && isset($_POST["lastName"])) {
        $userName = $_POST["username"];
        $userID = $_POST["userID"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];

        $query = "UPDATE `user` SET `username` = '$userName',`firstName` = '$firstName',`lastName` = '$lastName' WHERE `userID` = '$userID';";
        // echo $query;
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





       //SELECT
       $query = "SELECT `userID`, `username`, `firstName`, `lastName`, `accountState`, `email` FROM `user` WHERE `accessLevel` = 2"; 
      $run = mysqli_query($db_connect, $query);


      ?>


      <table id="dataTable" class=" table table-bordered table-striped pt-3">
        <thead>
          <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Edit</th>
            <!--  <th>Delete</th>  -->
          </tr>
        </thead>
        <tbody>
          <?php while ($result = mysqli_fetch_assoc($run)) { ?>
            <tr>
              <td><?php echo $result["username"] ?></td>
              <td><?php echo $result["firstName"] ?></td>
              <td><?php echo $result["lastName"] ?></td>
              <td><?php echo $result["email"] ?></td>
              <td><a href="" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-username="<?php echo $result["username"] ?>" data-bs-id="<?php echo $result["userID"] ?>" data-bs-firstname="<?php echo $result["firstName"] ?>" data-bs-lastname="<?php echo $result["lastName"] ?>"> <i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            </tr>

          <?php } ?>

        </tbody>
      </table>

      <!-- ///////////////////MODALS//////////////////////// -->
      <!--
      <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Create Subject</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
              <div class="modal-body">
                <p>Create a new Subject</p>
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Subject Name</label>
                  <input name="addSubject" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Subject Name" required>
                </div>

                <div class="mb-3">
                  <label for="select" class="form-label">Subject Name</label>
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
      </div>-->
      <!--ADD SUBJECT  Modal -->


      <!-- EDIT MODAL  -->


      <div class="modal fade" id="editModal<?php //echo $result["userID"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <div class="modal-body">

                <div class="mb-3">   
                  <label for="user-name" class="col-form-label">Lecturer Username:</label>
                  <input type="text" name="user-name" class="form-control user-name" id="user-name">
                  <input type="hidden" name="user-id" class="form-control user-id" id="user-id">
                  </div>

                <div class="mb-3">   
                  <label for="first-name" class="col-form-label">Lecturer First Name:</label>
                  <input type="text" name="first-name" class="form-control first-name" id="first-name">
                  </div>

                  <div class="mb-3">   
                  <label for="last-name" class="col-form-label">Lecturer Surname:</label>
                  <input type="text" name="last-name" class="form-control last-name" id="last-name">
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
  //edit modal
  const editModal = document.getElementById('editModal')
  editModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const username = button.getAttribute('data-bs-username')
    const firstname = button.getAttribute('data-bs-firstname')
    const lastname = button.getAttribute('data-bs-lastName')
    const id = button.getAttribute('data-bs-id')

    const modalTitle = editModal.querySelector('.modal-title')
    const modalUserInput = editModal.querySelector('.modal-body .user-name')
    const modalUIDInput = editModal.querySelector('.modal-body .user-id')
    //const modalSubjectInput = editModal.querySelector('.modal-body input')
    //const modalCourseInput = editModal.querySelector('.modal-body2 input')

    modalTitle.textContent = `Editng User: ${username}`
    modalUserInput.value = username
    modalUIDInput.value = id
    //modalCourseInput.value = course
  })
</script>


</html>
