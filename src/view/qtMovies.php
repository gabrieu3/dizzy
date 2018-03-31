<?php
include("MovieController.php");

$controller = new MovieController();

echo $controller->getQtMovies();
