<?php
require('../controller/'.'MovieController.php');

$pagination = (isset($_GET['pagination']))   ? $_GET['pagination']   : 0 ;
$search 	  = (isset($_GET['search']))   	   ? $_GET['search']   	   : "";

$controller = new MovieController();
$movieList = $controller->getMovies($pagination, $search);

while ($dados = $movieList->fetch_array()){
	echo '<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top" alt="Celular" style="height: 400px; width: 100%; display: block;" src="src/view/image.php?cod='.$dados['cod'].'" data-holder-rendered="true">
						<div class="card-body">
							<p class="card-text">
									'. $dados['title'] .' </br>
									<small class="text-muted">'. $dados['type'] . '</small>
							</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<form action="src/view/view.php" method="post">
									  <input type="hidden" id="link" name="link" value="'. $dados['link'] .'">
										<input type="hidden" id="cod" name="cod" value="'. $dados['cod'] .'">
										<button type="submit" class="btn btn-default btn-sm btn-outline-secondary">View '.$dados['view'].'</button>
										<button type="button" onclick="window.location.href = \''.$controller->getSearchYoutube($dados['cod'],$dados['title']).' \' " class="btn btn-default btn-sm btn-outline-secondary">Trailer</button>
										<button type="button" onclick="window.open(\''.$controller->getSearchImdb($dados['cod'],$dados['title']).'\',\'_blank\');" class="btn btn-default btn-sm btn-outline-secondary">Imdb</button>
									</form>
								</div>
								<small class="text-muted">'. $dados['time'] . '</small>


							</div>
						</div>
					</div>
				</div>';
}
