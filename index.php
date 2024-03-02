<?php

require_once('jRoute/_load.php');

$route = new jRoute("/Collaborative_Software_Group_4");

$route->Route(['get'], '/leaderboard', "pages/leaderboard.php");

$route->Route(['get'], '/login', "pages/login.php");

$route->Route(['get'], '/register', "pages/registration.php");

$route->Route(['get'], '/studentDisplay', "pages/studentManagementDashboard.php");

$route->Route(['get'], '/studentProfile/{id}', "pages/studentProfile.php");

$route->Route(['get'], '/testDashboard', "pages/testDashboard.php");

$route->Route(['get'], '/testManagement', "pages/testManagement.php");

$route->Route(['get'], '/disableAccount/{id}', "functionality/disableAccount.php");

$route->Route(['get'], '/approveAccount/{id}', "functionality/approveAccount.php");

echo $route->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>