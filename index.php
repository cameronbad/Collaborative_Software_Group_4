<?php

// Hides strict standard output
error_reporting(error_reporting() & ~E_STRICT & ~E_DEPRECATED); 

require_once('jRoute/_load.php');

$route = new jRoute("/Collaborative_Software_Group_4");

//Pages

$route->Route(['get'], '/', "pages/landing.php");

$route->Route(['get'], '/leaderboard', "pages/leaderboard.php");

$route->Route(['get'], '/login', "pages/login.php");

$route->Route(['get'], '/login{error}', "pages/login.php");

$route->Route(['get'], '/register', "pages/registration.php");

$route->Route(['get'], '/studentDisplay', "pages/studentManagementDashboard.php");

$route->Route(['get'], '/studentProfile/{id}', "pages/studentProfile.php");

$route->Route(['get'], '/testDashboard', "pages/testDashboard.php");

$route->Route(['get'], '/testManagement', "pages/testManagement.php");

$route->Route(['get'], '/test_{resultID}', "pages/test.php");

$route->Route(['get'], '/classManagement', "pages/classManagementTable.php");

//Includes
$route->Route(['get'], '/disableAccount/{id}', "functionality/disableAccount.php");

$route->Route(['get'], '/approveAccount/{id}', "functionality/approveAccount.php");

$route->Route(['get'], '/terminateAccount/{id}', "functionality/terminateAccount.php");

echo $route->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>