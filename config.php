<?php

define('DEBUG', false);

/** Absolute path. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

define('JSPATH',ABSPATH.'js/');
define('CSSPATH',ABSPATH.'css/');
define('IMGPATH',ABSPATH.'img/');

define('VIEWPATH',ABSPATH.'src/view/');
define('CNTRLPATH',ABSPATH.'src/controller/');
define('DAOPATH',ABSPATH.'src/dao/');
define('DTOPATH',ABSPATH.'src/dto/');
define('DBPATH',ABSPATH.'src/db/');
define('UTILPATH',ABSPATH.'src/util/');



 //Sets up WordPress vars and included files.
//require_once(ABSPATH . 'wp-settings.php');
