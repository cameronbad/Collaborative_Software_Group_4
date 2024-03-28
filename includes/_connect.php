<?php //Check if this file is being included or called directly
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404); //Act like this page doesn't exist
    die();
}

//Database login
$db_server = "plesk.remote.ac";
$db_user = "ws350074_csd";
$db_password = "L354&t7ujr72s9t~U1";
$db_database = "ws350074_csd";
$db_connect = new mysqli($db_server,$db_user,$db_password,$db_database);

//Error response
if (!$db_connect) {
    echo "Error: Unable to connect!";
}
