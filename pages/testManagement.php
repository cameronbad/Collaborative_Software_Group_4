<?php @session_start(); 
if ($_SESSION['accessLevel'] == 2 || $_SESSION['accessLevel'] == 3) {
    //Auth passed
} else if ($_SESSION['accessLevel'] == 1) {
    //Auth failed, student
    header("Location: ./testDashboard");
    die();
} else {
    //Not logged in
    header("Location: ./");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTest | Test Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Load Navbar -->
        <?php include_once("includes/navbar.php"); ?>
        <div class="container mt-5">
            <!-- Table to display list of tests to manage -->
            <table id="testManagementTable" class="table table-bordered table-striped table-card">
                <?php include("includes/testManagementTable.php"); ?>
            </table>

            <!-- Button to create new tests -->
            <div class="card card-body mb-4">
                <div class="row">
                    <div class="col d-grid">
                        <a type="button" class="btn btn-success" data-bs-toggle='modal' data-bs-target='#testModal'>
                            Create new test
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once("includes/testManagementModal.php"); ?>

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
                                    <?php include_once("includes/filtersDisplay.php"); ?>
                                </select>
                                <label for="eSubjectSelect" class="from-label">Subject</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" id="eAmount" name="eAmount" class="form-control" placeholder="Question Amount" required>
                                <label for="eAmount" class="from-label">Question Amount</label>
                            </div>
                            <div class="form-floating">
                                <input type="datetime-local" id="eSchedule" name="eSchedule" class="form-control" placeholder="Scheduled Time" required>
                                <label for="eSchedule" class="from-label">Scheduled Time</label>
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

        <!-- ASSIGN MODAL -->
        <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="assignLabel">Assign a new class</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" method="POST" id="assignForm">
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                This will assign all students in the selected class to complete the test.
                            </div>
                            <div class="form-floating mb-3" id="assignSelect">
                                
                            </div>
                        </div>

                        <input type="hidden" id="aTestID" name="aTestID" class="form-control" readonly>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
        <!-- END ASSIGN MODAL -->

        <!-- DELETE MODAL -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editLabel">Delete</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" method="POST" id="deleteForm">
                        <div class="modal-body">
                            Are you sure you wish to delete this course?
                        </div>                   
                        <input type="hidden" id="dTestID" name="dTestID" class="form-control" readonly>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
        <!-- END DELETE MODAL -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="includes/_functions.js"></script>
    <script>
        //AJAX call to create a test
        ajaxFormSubmit('#testForm', "./functionality/createTest.php", false);

        //AJAX call to edit a test
        ajaxFormSubmit('#editForm', "./functionality/editTest.php", false);

        //AJAX call to assign a class a test
        ajaxFormSubmit('#assignForm', "./functionality/assignTest.php", false);

        //AJAX call to delete a test
        ajaxFormSubmit('#deleteForm', "./functionality/deleteTest.php", false);

        //Updates test whenever an AJAX call is complete
        $(document).on("ajaxSuccess", function() {
           $.ajax({
                url: './includes/testManagementTable.php',
                global: false,
                success: function(data) {
                    $('#testManagementTable').html(data);
                }
           }); 
        });

        //Edit Modal JS
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', event => {

            //Button that triggered the modal
            const button = event.relatedTarget;

            //Extract data from data-bs-*
            const testID = button.getAttribute('data-bs-tid');

            //Update content
            const eTestID = document.getElementById("eTestID");
            eTestID.value = testID;
        });

        //Assign Modal JS
        const assignModal = document.getElementById('assignModal');
        assignModal.addEventListener('show.bs.modal', event => {

            //Button that triggered the modal
            const button = event.relatedTarget;

            //Extract data from data-bs-*
            const testID = button.getAttribute('data-bs-tid');
            const courseID = button.getAttribute('data-bs-cid');

            //Update content
            const aTestID = document.getElementById("aTestID");
            aTestID.value = testID;

            $.ajax({
                url: "./includes/assignModal.php",
                method: "POST",
                global: false,
                data: {courseID:courseID},
                success: function(data)
                {
                $('#assignSelect').html(data);
                }
            });
        });

        //Delete Modal JS
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', event => {

            //Button that triggered the modal
            const button = event.relatedTarget;

            //Extract data from data-bs-*
            const testID = button.getAttribute('data-bs-tid');

            //Update content
            const dTestID = document.getElementById("dTestID");
            dTestID.value = testID;
        });
    </script>
</body>
</html>