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
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Subject</td>
                        <td>50</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </tbody>
            </table>

            <!-- Button to create new tests -->
            <div class="row">
                <div class="col d-grid">
                    <a type="button" class="btn btn-success" href="#">
                        Create new test
                    </a>
                </div>
            </div>

        </div>
    </main>
</body>
</html>