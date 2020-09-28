<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' .DS . 'xampp' . DS . 'htdocs' . DS . 'php-courses' . DS. 'php_oop' . DS . 'photo_gallery');
defined('INCLUDES_PATH') ? null : define("INCLUDES_PATH", SITE_ROOT . DS . 'admin' . DS . 'includes');


require_once('functions.php');
require_once('db_config.php');
require_once('db.php');
require_once('db_object.php');
require_once('user.php');
require_once('photo.php');
require_once('session.php');
require_once('comment.php');
require_once('paginate.php');


