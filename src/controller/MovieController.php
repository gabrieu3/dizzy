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

	public function insertMovie($movie){
		$this->dao->insertMovie($movie);
	}

	public function getImage($cod){
		return $this->dao->getImage($cod);
	}

	public function insertView($cod){
    $this->dao->insertView($cod);
	}

	public function getView($cod){
		return $this->dao->getView($cod);
  }

  public function getSearchYoutube($cod, $string){
		
		$pos = 0;
		$posAr = [];
		$posAr[0] = (strpos(strtoupper($string),'TORRENT') != null) ? strpos(strtoupper($string),'TORRENT') : 1000 ;
		$posAr[1] = (strpos($string,'(') != null) ? strpos($string,'(') : 1000 ;
		$posAr[2] = (strpos($string,'/') != null) ? strpos($string,'/') : 1000 ;
		$posAr[3] = (strpos($string,'-') != null) ? strpos($string,'-') : 1000 ;
		$posAr[4] = (strpos($string,'–') != null) ? strpos($string,'–') : 1000 ;
		$posAr[5] = 30;

		$pos = min($posAr);

    return 'http://www.youtube.com/results?search_query=Trailer+'. substr($string,0, $pos);

	}
}
