<?php //Check if this file is being included or called directly
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404); //Act like this page doesn't exist
    die();
}
?>    
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
                                    <?php include("includes/filtersDisplay.php"); ?>
                                </select>
                                <label for="tSubjectSelect" class="from-label">Subject</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" id="tAmount" name="tAmount" class="form-control" placeholder="Question Amount" required>
                                <label for="tAmount" class="from-label">Question Amount</label>
                            </div>
                            <?php 
                            if($_SESSION['accessLevel'] != '1') {
                                echo '<div class="form-floating">
                                    <input type="datetime-local" id="tSchedule" name="tSchedule" class="form-control" placeholder="Scheduled Time" required>
                                    <label for="tSchedule" class="from-label">Scheduled Time</label>
                                </div>';
                            }
                            ?>
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