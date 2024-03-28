<?php

include_once("includes/_connect.php");

if(!isset($_SESSION['username'])) //Checks if the username has been set
{
    header("Location: ./"); //Redirects them to the login page
    die("Error, please login.");
}

?>