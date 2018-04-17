<?php

require('../api/Remote.php');

$apiUrl = "http://www.torrentdosfilmeshd.net/page/2/";
$remote = new Remote();


echo $remote->fetchJSON($apiUrl);
?>
