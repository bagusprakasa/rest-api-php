<?php
require_once('../../env.php');
define('HOST', getenv("DB_HOST"));
define('USER', getenv("DB_USER"));
define('DB', getenv("DB_NAME"));
define('PASS', getenv("DB_PASSWORD"));
$conn = new mysqli(HOST, USER, PASS, DB) or die('Connetion error to the database');
