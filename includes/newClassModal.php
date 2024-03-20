<div class="modal fade" id="newClassModal" name="newClassModal" tabindex="-1" aria-labelledby="newClassModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newClassModalLabel">Create New Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="newClassForm" name="newClassForm" method="POST">
            <div class="mb-3">
                <label for="classNameInput" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="classNameInput" name="classNameInput" placeholder="Class Name">
            </div>
            <div class="mb-3">
                <label for="classCourseName" class="form-label">Course</label>
                <select type="select" class="form-select col" id="classCourseName" name="classCourseName">
                    <?php include_once("classNameDisplay.php") ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>