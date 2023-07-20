<?php
$servername = "localhost";
$username = "root";
$password = "senha";
$dbname = "nome-banco de dados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>