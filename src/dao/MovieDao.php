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

	public function getMovies($pagination, $search){

		$pagination = ($pagination == 1 or $pagination == 0) ? 0 : $pagination - 1;
		if ($search == "" or trim($search) == "" or $search === null){
			$sql = "select * from (SELECT cod, title, type, star, link, src, image, date_format(time, '%d/%m/%Y') time, view FROM movie where length(image) > 0 order by cod desc) x order by cod desc LIMIT ".($pagination * 12).", 12 " ;
		}else {
			$sql = "select * from (SELECT cod, title, type, star, link, src, image, date_format(time, '%d/%m/%Y') time, view FROM movie where upper(title) like '%".strtoupper(trim($search))."%' and length(image) > 0 order by cod desc) x order by cod desc LIMIT ".($pagination * 12).", 12 " ;
		}
		//echo $sql;

		$this->movieList = $this->conn->query($sql);
		return $this->movieList;

	}

	public function getQtMovies($search){
		if ($search == "" or trim($search) == "" or $search === null){
			$sql = "select count(1) FROM movie where image is not null" ;
		}else {
			$sql = "select count(1) FROM movie where upper(title) like '%".strtoupper(trim($search))."%' and image is not null";
		}

		$this->qtMovies = $this->conn->query($sql);
		return $this->qtMovies;

	}

	public function existMovies($title){

		$sql = "select count(1) FROM movie where title = '".$title."' and length(image) > 0";
		$existsResult = $this->conn->query($sql);
		while ($e = $existsResult->fetch_array()){
			return $e[0];
		}
		return 0;
	}

	public function insertMovie($movie){
		if ($this->existMovies($movie->getTitle()) == 0){
	    $image = mysqli_real_escape_string($this->conn, file_get_contents($movie->getSrc()));
			$sql = "insert into movie(title,link,src,image,time,view,type) values('".$movie->getTitle()."','".$movie->getlink()."','".$movie->getSrc()."','$image',SYSDATE(),0,'".$movie->getType()."')";
			$this->conn->query($sql);
		}
	}

	public function getImage($cod){

		$sql = "select image FROM movie where cod=".$cod;
		$result = mysqli_query($this->conn, $sql);
		return mysqli_fetch_assoc($result);

	}


	public function insertView($cod){
    $conter = $this->getView($cod) + 1;
		$sql = "update movie set view = ".$conter." where cod = ".$cod;
		mysqli_query($this->conn, $sql);
	}

	public function getView($cod){
		$sql = "select IFNULL(view, 0) view from movie where cod = ".$cod;
		$result = mysqli_query($this->conn, $sql);
		while ($e = $result->fetch_array()){
			return $e[0];
		}
		return 0;
	}



}
