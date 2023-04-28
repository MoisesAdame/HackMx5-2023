<?php
$server = "localhost";
$username = "root";
$password = "Javieruchiha1";



$database = "hack2MX";
// Conectar
$connection = new mysqli($server, $username, $password,$database);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$connection->set_charset("utf8");

function simpleQuery($sql)
{
	global $connection;
  if(!strpos($sql, ";")){
    $query = $connection->query($sql);
  	return $query;
  }
  return NULL;
}
?>
