<?php
require('../controller/'.'MovieController.php');

$pagination = (isset($_GET['pagination']))   ? $_GET['pagination']   : 0;

$controller = new MovieController();
$movieList = $controller->getMovies($pagination);

while ($dados = $movieList->fetch_array()){
	echo '<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top" alt="Celular" style="height: 400px; width: 100%; display: block;" src="src/view/image.php?cod='.$dados['cod'].'" data-holder-rendered="true">
						<div class="card-body">
							<p class="card-text">
										<b>Cod: '  . $dados['cod']  . '</b></br>
									'. $dados['title'] .' </br>
									<small class="text-muted">'. $dados['type'] . '</small>
							</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<form action="src/view/view.php" method="post">
									  <input type="hidden" id="link" name="link" value="'. $dados['link'] .'">
										<input type="hidden" id="cod" name="cod" value="'. $dados['cod'] .'">
										<button type="submit" class="btn btn-sm btn-outline-secondary">View '.$dados['view'].'</button>
									</form>
								</div>
								<small class="text-muted">'. $dados['time'] . '</small>


							</div>
						</div>
					</div>
				</div>';
}
