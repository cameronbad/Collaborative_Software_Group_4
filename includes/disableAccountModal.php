<div class="modal fade" id="disableModal" name="disableModal" tabindex="-1" aria-labelledby="disableModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="disableModalLabel"><?php echo $username ?> account disable</h5> <!-- Uses the username from the get query on studentProfile -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button type="submit" class="btn btn-danger" id="disableBtnModal" name="disableBtnModal" data-bs-dismiss="modal">Disable</button> <!-- Disables account -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <!-- Closes modal -->
      </div>
    </div>
  </div>
</div>