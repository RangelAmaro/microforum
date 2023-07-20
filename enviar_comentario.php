<?php
//conectar com o banco mysql
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Verificar se o formulário de envio de comentário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comentario"])) {
    $comentario = $_POST["comentario"];

    // Inserir o comentário no banco de dados
    $sql = "INSERT INTO comentarios (comentario) VALUES ('$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

$conn->close();
?>