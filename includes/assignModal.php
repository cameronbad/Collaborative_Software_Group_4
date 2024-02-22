<select id="classSelect" name="classSelect" class="form-select">
    <option selected></option>
    <?php
    include_once("./_connect.php");
    $query = "SELECT `class`.* FROM `class` WHERE `class`.`courseID` = " . $_POST["courseID"];
    $run = mysqli_query($db_connect, $query);

    while ($result = mysqli_fetch_assoc($run)) {
        echo "<option value='" . $result["classID"] . "'>" . $result["className"] . "</option>";
    }                 
    ?>
</select>
<label for="classSelect" class="from-label">Class</label>