<?php
include("MovieController.php");

$pagination = (isset($_GET['pagination']))   ? $_GET['pagination']   : 0;

$controller = new MovieController();
$movieList = $controller->getMovies($pagination);

while ($dados = $movieList->fetch_array()){
	echo '<div class = "post">';

		echo '<div class = "post-image">';
			echo '<image alt="celular" src="img/celular.jpg">';
		echo '</div>';

		echo '<div class = "post-title">';
			echo 'Title: ' . $dados['title'] . '<br>';
		echo '</div>';

		echo '<div class = "post-info">';
			echo 'Cod: ' . $dados['cod'] . '<br>';
			echo 'Type: ' . $dados['type'] . '<br>';
			echo 'Star: ' . $dados['star'] . '<br>';
		echo '</div>';

		echo '<div class = "post-bottom"></div>';

	echo '</div>';
}
