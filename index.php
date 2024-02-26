<?php

require_once('jRoute/_load.php');

$route = new jRoute("/Collaborative_Software_Group_4");

$route->Route(['get'], '/landing', "pages/landing.php");

$route->Route(['get'], '/leaderboard', "pages/leaderboard.php");

$route->Route(['get'], '/login', "pages/login.php");

$route->Route(['get'], '/register', "pages/registration.php");

$route->Route(['get'], '/studentDashboard', "pages/studentManagementDashboard.php");

$route->Route(['get'], '/testDashboard', "pages/testDashboard.php");

$route->Route(['get'], '/testManagement', "pages/testManagement.php");

echo $route->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>