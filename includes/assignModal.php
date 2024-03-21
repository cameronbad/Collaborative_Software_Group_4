<?php //Check if this file is being included or called directly
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404); //Act like this page doesn't exist
    die();
}
?>    
<select id="classSelect" name="classSelect" class="form-select">
    <option selected></option>
    <?php
    include_once("./_connect.php");
    $query = "CALL getClasses(?)";
    $run = $db_connect->execute_query($query, [$_POST["courseID"]]);

    while ($result = $run->fetch_assoc()) {
        echo "<option value='" . $result["classID"] . "'>" . $result["className"] . " - " . $result["classCount"] . " students " . "</option>";
    }                 
    ?>
</select>
<label for="classSelect" class="from-label">Class</label>