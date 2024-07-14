<?php
$servername = "localhost";
$username = "u693436268_redesocial";
$password = "JU;=3n^1s~7o";
$dbname = "u693436268_redesocial";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>