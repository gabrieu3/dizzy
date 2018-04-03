<?php

require('../dao/'.'MovieDao.php');

Class MovieController{

	private $movieList;
	private $movie;
	private $dao;
	private $dto;


	public function __construct(){
		$this->dao = new MovieDao();
	}

	private function round_up($number, $precision = 0)
	{
	    $fig = (int) str_pad('1', $precision, '0');
	    return (ceil($number * $fig) / $fig);
	}

	public function getMovies($pagination){
		return $this->dao->getMovies($pagination);
	}

	public function getQtMovies(){
		$qtMoviesResult = $this->dao->getQtMovies();
		while ($qt = $qtMoviesResult->fetch_array()){
			return $qt[0];
		}
		return 0;
	}

	public function getQtPages(){
		return $this->round_up($this->getQtMovies() / 12,0);
	}


}
