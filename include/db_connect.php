<?php

require_once "config.php";

$dsn = "mysql:dbname=$db_name;host=$db_host;port=$db_port;charset=utf8";

try {
	$db = new PDO($dsn, $db_user, $db_password);
} catch(PDOException $e) {
	die('Could not connect to the database:<br/>' . $e);
}
