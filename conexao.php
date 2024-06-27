<?php
// Aqui é feita a conexão com o banco de dados
$usuario = 'root';
$senha = '';
$database = 'listatarefas';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli ->error) {
    die("Falha na conexão com o banco de dados: " . $mysqli->error);
}