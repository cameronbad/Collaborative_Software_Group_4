<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTest | Test Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Load Navbar -->
        <?php include_once("includes/navbar.php"); ?>
        <div class="container mt-5">
            <!-- Table to display list of tests to manage -->
            <table id="modalTable" class="table table-bordered table-striped table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Test Name</th>
                        <th>Subject</th>
                        <th>Amount of Questions</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("includes/_connect.php");
                    $query = "SELECT `test`.*, `subject`.`subjectName`, `subject`.`courseID` FROM `test` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID` WHERE `subject`.`courseID` = 1" ; //Replace 1 with session value for courses once login has been implemented
                    //For Admin, could also add course name to their version? |Could feature|
                    //$query = "SELECT `test`.*, `subject`.`subjectName` FROM `test` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID`" ;
                    $run = mysqli_query($db_connect, $query);
                    while ($result = mysqli_fetch_assoc($run)) {
                        echo "<tr>";
                        echo "<td>" . $result["testID"] . "</td>";
                        echo "<td>" . $result["testName"] . "</td>";
                        echo "<td>" . $result["subjectName"] . "</td>";
                        echo "<td>" . $result["questionAmount"] . "</td>"; 
                        echo "<td> <button type='button' class='btn btn-primary' data-bs-tid='" . $result["testID"] . "'data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button></td>";
                        echo "<td> <button type='button' class='btn btn-danger'>Remove</button> </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Button to create new tests -->
            <div class="card card-body mb-4">
                <div class="row"> <!-- courseSelect selector, potentially for admins. -->
                    <!--<div class="col-3">
                        <select id="courseSelect" name="courseSelect" class="form-select">
                            <option selected>Select a course</option>
                            <?php
                            //include_once("includes/_connect.php");
                            //$query = "SELECT `course`.* FROM `course`";
                            //$run = mysqli_query($db_connect, $query);
                            //while ($result = mysqli_fetch_assoc($run)) {
                            //    echo "<option value='" . $result["courseID"] . "'>" . $result["courseName"] . "</option>";
                            //}
                            ?>
                        </select>
                    </div>-->

                    <div class="col d-grid">
                        <a type="button" class="btn btn-success" data-bs-toggle='modal' data-bs-target='#testModal'>
                            Create new test
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CREATE MODAL -->
        <div class="modal fade" id="testModal" tabindex="-1" aria-labelledby="testLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="testLabel">Create</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" method="POST" id="testForm">
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" id="tName" name="tName" class="form-control" placeholder="Test Name" required>
                                <label for="tName" class="from-label">Test Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select id="tSubjectSelect" name="tSubjectSelect" class="form-select">
                                    <option selected></option>
                                    <?php
                                    include_once("includes/_connect.php");
                                    $query = "SELECT `subject`.* FROM `subject` WHERE `subject`.`courseID` = '1'"; //Replace 1 with session value for courses once login has been implemented
                                    //For Admin, Could grab subjects based off courseID in courseSelect, probably going to need AJAX
                                    $run = mysqli_query($db_connect, $query);
                                    while ($result = mysqli_fetch_assoc($run)) {
                                        echo "<option value='" . $result["subjectID"] . "'>" . $result["subjectName"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="tSubjectSelect" class="from-label">Subject</label>
                            </div>
                            <div class="form-floating">
                                <input type="number" id="tAmount" name="tAmount" class="form-control" placeholder="Question Amount" required>
                                <label for="tAmount" class="from-label">Question Amount</label>
                            </div>
                        </div>                   
                        <input type="hidden" id="tTestID" name="tTestID" class="form-control" readonly>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
        <!-- END CREATE MODAL -->

        <!-- EDIT MODAL -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editLabel">Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" method="POST" id="editForm">
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" id="eName" name="eName" class="form-control" placeholder="Test Name" required>
                                <label for="eName" class="from-label">Test Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select id="eSubjectSelect" name="eSubjectSelect" class="form-select">
                                    <option selected></option>
                                    <?php
                                    include_once("includes/_connect.php");
                                    $query = "SELECT `subject`.* FROM `subject` WHERE `subject`.`courseID` = '1'"; //Replace 1 with session value for courses once login has been implemented
                                    $run = mysqli_query($db_connect, $query);
                                    while ($result = mysqli_fetch_assoc($run)) {
                                        echo "<option value='" . $result["subjectID"] . "'>" . $result["subjectName"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="eSubjectSelect" class="from-label">Subject</label>
                            </div>
                            <div class="form-floating">
                                <input type="number" id="eAmount" name="eAmount" class="form-control" placeholder="Question Amount" required>
                                <label for="eAmount" class="from-label">Question Amount</label>
                            </div>
                        </div>                   
                        <input type="hidden" id="eTestID" name="eTestID" class="form-control" readonly>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
        <!-- END EDIT MODAL -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        //AJAX call to create a test
        $('#testForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "./createTest.php",
                method: "POST",
                data: $('#testForm').serialize(),
                success: function(data) {
                    location.reload();
                }
            })
        });

        //AJAX call to edit a test
        $('#editForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "./editTest.php",
                method: "POST",
                data: $('#editForm').serialize(),
                success: function(data) {
                    location.reload();
                }
            })
        });

        //Modal JS
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', event => {

        //var courseSelect = document.getElementByID('courseSelect');
        //var courseValue = courseSelect.value;

        //Button that triggered the modal
        const button = event.relatedTarget;

        //Extract data from data-bs-*
        const testID = button.getAttribute('data-bs-tid');

        //Update content
        const eTestID = document.getElementById("eTestID");
        eTestID.value = testID;

        });
    </script>
</body>
</html>