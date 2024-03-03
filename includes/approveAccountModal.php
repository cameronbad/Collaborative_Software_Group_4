<div class="modal fade" id="approveModal" name="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel"><?php echo $username ?> account approve</h5> <!-- Uses the username from the get query on studentProfile -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button type="submit" class="btn btn-danger" id="approveBtnModal" name="approveBtnModal" data-bs-dismiss="modal">Approve</button> <!-- Approves account -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <!-- Closes modal -->
      </div>
    </div>
  </div>
</div>