<?php //Check if this file is being included or called directly
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404); //Act like this page doesn't exist
    die();
}

include_once("_connect.php");  
?>
<div class="container test-box"> 
    <div class="top-50 start-50 translate-middle card"> <!-- card is temp for styling-->
        Test Over
    </div>
</div>