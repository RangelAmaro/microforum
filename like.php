<?php
//conectar com o banco mysql
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// verificar se o ID do comentário foi fornecido
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("ID do comentário inválido.");
}

$comentarioId = $_GET["id"];

// adicionar like ao comentário
$sql = "INSERT INTO likes_comentario (comentario_id, likes) VALUES ($comentarioId, 1)
        ON DUPLICATE KEY UPDATE likes = likes + 1";

if ($conn->query($sql) === TRUE) {
    // pop-up de agradecimento
    echo "<script>
              alert('Obrigado pelo like!');
              window.history.back();
          </script>";
} else {
    echo "Erro ao adicionar like: " . $conn->error;
}

$conn->close();
?>