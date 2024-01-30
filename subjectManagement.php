
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/r-2.5.0/sr-1.3.0/datatables.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="Images/EduTestLogo.png" type="image/x-icon">
</head>
  <body>
  <?php include_once("includes/navbar.php"); ?>
    <h1>subject management page</h1>

    <table id="modalTable" class="table table-bordered table-striped table-card">

       <thead>
          <tr>
             <th>ID</th>
                <th>Subject Name</th>
                <!--<?php if ($_SESSION['accessLevel'] == '3') {echo '<th>Course</th>';}?> -->
                <th>Number of Questions</th>
                <th>Questions</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
  </body>
</html>