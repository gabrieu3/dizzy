<?php
Class DbConnection{

	private $conn;

	public function __construct(){
		$this->conn = mysqli_connect("localhost","root","","sitezin") or die("Couldn't connect");
	}

	public function getDBConnect(){
        return $this->conn;
  }

}
?>
