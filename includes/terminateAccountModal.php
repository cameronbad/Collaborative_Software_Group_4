<div class="modal fade" id="terminateModal" name="terminateModal" tabindex="-1" aria-labelledby="terminateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="terminateModalLabel">You are about to terminate <?php echo $username ?>, are you sure?</h5> <!-- Uses the username from the get query on studentProfile -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button type="submit" class="btn btn-danger" id="terminateBtnModal" name="terminateBtnModal" data-bs-dismiss="modal">Terminate</button> <!-- terminates account -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <!-- Closes modal -->
      </div>
    </div>
  </div>
</div>