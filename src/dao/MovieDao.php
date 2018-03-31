<?php
include("MovieDto.php");
include("db.php");

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
		$sql = "select * from (SELECT cast(cod as decimal) cod, title, type, star FROM movie order by cast(cod as decimal)) x LIMIT ".($pagination * 10).", 10 " ;
		$this->movieList = $this->conn->query($sql);
		return $this->movieList;

	}

	public function getQtMovies(){

		$sql = "select count(1) FROM movie" ;
		$this->qtMovies = $this->conn->query($sql);
		return $this->qtMovies;

	}




}
