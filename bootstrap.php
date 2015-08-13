<?php
session_start();

define('DB_HOST', '127.0.0.1');
define('DB_NAME','pablo_db');
define('DB_USER','pablo_user');
define('DB_PASS','duckthis');

$dbc = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once 'utils/Input.php';
require_once 'utils/Logger.php';
require_once 'utils/Auth.php';
require_once 'models/BaseModel.php';
require_once 'models/User.php';
require_once 'models/Ad.php';
require_once 'models/Tag.php';
?>
