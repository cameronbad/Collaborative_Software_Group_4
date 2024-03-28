<div class="modal fade" id="assignClassModal" name="assignClassModal" tabindex="-1" aria-labelledby="assignClassModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignClassModalLabel"><?php echo $username ?> Class Assign</h5> <!-- Uses the username from the get query on studentProfile -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="POST" id="classAssignForm" name="classAssignForm">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="assignClassName" class="form-label">Classes</label>
                    <select type="select" class="form-select col" id="assignClassName" name="assignClassName">
                        <?php include_once("classSelectOutput.php") ?>
                    </select>
                    <input type="input" id="assignClassUser" name="assignClassUser" value="<?php echo $userID ?>" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="assignBtnModal" name="assignBtnModal" data-bs-dismiss="modal">Assign</button> <!-- Approves account -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <!-- Closes modal -->
            </div>
        </form>
    </div>
  </div>
</div>