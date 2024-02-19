<?php

require_once('jRoute/_load.php');

$route = new jRoute("/Collaborative_Software_Group_4");

$route->Route(['get'], '/leaderboard', "leaderboard.php");

echo $route->Dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>