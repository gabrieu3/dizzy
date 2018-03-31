<?php
include("..\MovieController.php");

$controller = new MovieController();

$movieList = $controller->getMovies(10);

while ($dados = $movieList->fetch_array()){
	echo 'Cod: ' . $dados['cod'] . '<br>';
	echo 'Title: ' . $dados['title'] . '<br>';
	echo 'Type: ' . $dados['type'] . '<br>';
	echo 'Star: ' . $dados['star'] . '<br>';
}