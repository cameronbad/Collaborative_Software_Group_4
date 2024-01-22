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
                    $query = "SELECT `test`.*, `subject`.`subjectName` FROM `test` LEFT JOIN `subject` ON `test`.`subjectID` = `subject`.`subjectID`" ;
                    $run = mysqli_query($db_connect, $query);
                    while ($result = mysqli_fetch_assoc($run)) {
                        echo "<tr>";
                        echo "<td>" . $result["testID"] . "</td>";
                        echo "<td>" . $result["testName"] . "</td>";
                        echo "<td>" . $result["subjectName"] . "</td>";
                        echo "<td>" . $result["questionAmount"] . "</td>"; 
                        echo "<td> <button type='button' class='btn btn-primary'>Edit</button></td>";
                        echo "<td> <button type='button' class='btn btn-danger'>Remove</button> </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Button to create new tests -->
            <div class="row">
                <div class="col d-grid">
                    <a type="button" class="btn btn-success" data-bs-toggle='modal' data-bs-target='#testModal' href="#">
                        Create new test
                    </a>
                </div>
            </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="testModal" tabindex="-1" aria-labelledby="testLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="testLabel">Label</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Body text</label>
                        </div>
                    </div>
                    <form action="#" method="POST" id="testForm">
                        <input type="hidden" id="modal-testID" name="testID" class="form-control" value="" readonly>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Placeholder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
        <!-- END MODAL -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const testModal = document.getElementByID('testModal');
        testModal.addEventListener('show.bs.modal', event => {

        });
    </script>
</body>
</html>