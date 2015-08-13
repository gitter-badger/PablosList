<?php
// Load the environment variables.
$_ENV = include '../.env.php';
session_start();

define('DB_HOST', '127.0.0.1');
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);

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
