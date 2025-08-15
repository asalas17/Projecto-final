<?php

$server = "localhost";
$user = "root";
$pass = "";
$db_name = "agronatura_db";
$port = 3307;

$connection = new mysqli($server, $user, $pass, $db_name, $port);

if ($connection->connect_error) {
    die("Conexion fallida.". $connection->connect_error);
}