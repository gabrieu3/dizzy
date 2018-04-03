<?php

require('../dto/'.'MovieDto.php');
require('../util/'.'db.php');


Class MovieDao{

	private $conn;
	private $movie;
	private $movieList;
	private $qtMovies;
	private $db;


	public function __construct(){
		$db = new DbConnection();
		$this->conn = $db->getDBConnect();
	}

	public function getMovies($pagination){

		$pagination = ($pagination == 1 or $pagination == 0) ? 0 : $pagination - 1;
		$sql = "select * from (SELECT cod, title, type, star FROM movie order by cod) x LIMIT ".($pagination * 12).", 12 " ;
		$this->movieList = $this->conn->query($sql);
		return $this->movieList;

	}

	public function getQtMovies(){

		$sql = "select count(1) FROM movie" ;
		$this->qtMovies = $this->conn->query($sql);
		return $this->qtMovies;

	}




}
