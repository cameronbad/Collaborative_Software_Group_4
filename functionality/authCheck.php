<?php

include_once("includes/_connect.php");

if($_SESSION['accessLevel'] == 2 || $_SESSION['accessLevel'] == 3) //Checks that the user is permitted to view this page
{
    header("Location: ./"); //Redirects them to the login page
    die("Error, please login.");
}

?>