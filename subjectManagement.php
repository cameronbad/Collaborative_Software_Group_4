<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subject Management</title>
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

      <h1>Subject management page</h1>
      <p>Use the page below to manage subjects</p>
      <!-- Add New Subject Button  -->

      <!-- Button to trigger modal -->
      <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#createModal">
        + Create Subject
      </button>
      <br>




      <?php
      include_once("includes/_connect.php");
      //DELETE SUBJECT ---- OBSELETE BUT DELETING THIS BREAKS IT SO IT'S STAYING IN
      if (isset($_POST["DcourseID"])) {
      ?>
        <div class="alert alert-warning" role="alert">

          <?php
          echo "You have deleted Subject ID " . $_POST['DcourseID'];
          ?>
        </div>
      <?php

        $courseID = $_POST['DcourseID'];
        $query = "DELETE FROM 'subject' WHERE `subject`.`subjectID` = ?";

        $run = $db_connect->execute_query($query, [$courseID]);
      }
      //END OF OBSELETE CODE
      //ADD SUBJECT

      if (isset($_POST["addSubject"]) && isset($_POST["addCourse"])) {
        $addCourse = $_POST["addCourse"];
        $addSubject = $_POST["addSubject"];

        $query = "INSERT INTO `subject` (`subjectID`, `subjectName`, `courseID`) VALUES (NULL, ?, ?);";
        $run = $db_connect->execute_query($query, [$addSubject, $addCourse]);

      ?>
        <div class="alert alert-success" role="alert">
          New subject <?php echo $addSubject ?> has been added.
        </div>
        <?php

      }

      /////////////////////////////////EDIT/////////////////////////////////

      if (isset($_POST["subject-id"]) && isset($_POST["subject-name"]) && isset($_POST["courseSubject"])) {
        $subjectName = $_POST["subject-name"];
        $subjectID = $_POST["subject-id"];
        $select = $_POST["courseSubject"];

        $query = "UPDATE `subject` SET `subjectName` = ?, `courseID` = ? WHERE `subjectID` = ?;";
        $run = $db_connect->execute_query($query, [$subjectName, $select, $subjectID]);

        if ($run) {
        ?>
          <div class="alert alert-success" role="alert">
            Subject <?php echo $subjectName ?> has been updated.
          </div>
        <?php
        } else {
        ?>
          <div class="alert alert-danger" role="alert">
            Failed to update <?php echo $subjectName ?>.
          </div>
      <?php
        }
      }


      ////////////////////////////////END OF EDIT///////////////////////////


      //SELECT SUBECT
      $query = "SELECT `subject`.*, `course`.`courseName`
      FROM `subject` 
        LEFT JOIN `course` ON `subject`.`courseID` = `course`.`courseID`;";
      $run = mysqli_query($db_connect, $query);


      ?>


      <table id="dataTable" class=" table table-bordered table-striped pt-3">
        <thead>
          <tr>
            <th>ID</th>
            <th>Subject Name</th>
            <th>Course Name</th>
            <th>Edit</th>
            <!--  <th>Delete</th>  -->
          </tr>
        </thead>
        <tbody>
          <?php while ($result = $run->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $result["subjectID"] ?></td>
              <td><?php echo $result["subjectName"] ?></td>
              <td><?php echo $result["courseName"] ?></td>
              <td><a href="" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-subject="<?php echo $result["subjectName"] ?>" data-bs-sid="<?php echo $result["subjectID"] ?>" data-bs-subject="<?php echo $result["courseName"] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            </tr>

          <?php } ?>

        </tbody>
      </table>

      <!-- ///////////////////MODALS//////////////////////// -->


      <!--ADD SUBJECT  Modal -->
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
      <!--ADD SUBJECT  Modal -->


      <!-- EDIT MODAL  -->


      <div class="modal fade" id="editModal<?php ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Modal</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
            <div class="modal-body">
            
                <div class="mb-3">
                  <label for="subject-name" class="col-form-label">Subject Name:</label>
                  <input type="text" name="subject-name" class="form-control subject-name" id="subject-name">
                  <input type="hidden" name="subject-id" class="form-control subject-id" id="subject-id">

                </div>

                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Course Name:</label>
                  <select name="courseSubject" class="form-select" id="select"  aria-label="Default select example" required>
                    <option value="" selected>Please select a course...</option>
                    <?php
                    $query = "SELECT* from `course`";
                    $run = $db_connect->query($query);
                    while ($course = $run->fetch_assoc()) {
                      echo "<option value='" . $course["courseID"] . "'>" . $course["courseName"] . "</option>";
                    }
                    //Dropdown Menu for course select
                    ?>
                  </select>
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

  const editModal = document.getElementById('editModal');
  editModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    const subject = button.getAttribute('data-bs-subject');
    const course = button.getAttribute('data-bs-course');
    const sid = button.getAttribute('data-bs-sid');
    const modalTitle = editModal.querySelector('.modal-title');
    const modalSubjectInput = editModal.querySelector('.modal-body .subject-name');
    const modalSIDInput = editModal.querySelector('.modal-body .subject-id');
    //const modalSubjectInput = editModal.querySelector('.modal-body input');
    //const modalCourseInput = editModal.querySelector('.modal-body2 input');
    modalTitle.textContent = `Editng Subject: ${subject}`;
    modalSubjectInput.value = subject;
    modalSIDInput.value = sid;
    //modalCourseInput.value = course;
  })
</script>

</html>
