<?php
require('../controller/'.'MovieController.php');

$pagination = (isset($_GET['pagination']))   ? $_GET['pagination']   : 0;

$controller = new MovieController();
$movieList = $controller->getMovies($pagination);

while ($dados = $movieList->fetch_array()){
	echo '<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top" alt="Celular" style="height: 225px; width: 100%; display: block;" src="img/jl.jpg" data-holder-rendered="true">
						<div class="card-body">
							<p class="card-text">
							    <h4>Title: ' . $dados['title'] . '</h4>
									   Cod: '  . $dados['cod']  . '
										 Type: ' . $dados['type'] . '
										 Star: ' . $dados['star'] . '
							</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-outline-secondary">View</button>
									<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
								</div>
								<small class="text-muted">9 mins</small>
							</div>
						</div>
					</div>
				</div>';
}
