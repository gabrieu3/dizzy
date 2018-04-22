<?php
require('../controller/MovieController.php');

$cod = (int) $_GET['cod'];
$c = new MovieController();
$image = $c->getImage($cod);
header("Content-type : image/JPEG ");
echo $image['image'];

?>
