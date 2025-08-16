<?php

$server = "100.100.175.70";
$user = "lucia";
$pass = "luciaUfide1313";
$db_name = "agronatura_db";
$port = 3307;

$connection = new mysqli($server, $user, $pass, $db_name, $port);

if ($connection->connect_error) {
    die("Conexion fallida.". $connection->connect_error);
}
