<?php
//conectar com o banco mysql
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// função para inserir um comentário no banco
function inserirComentario($comentario)
{
    global $conn;

    $sql = "INSERT INTO comentarios (comentario, data_hora) VALUES ('$comentario', NOW())";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Erro ao inserir comentário: " . $conn->error;
        return false;
    }
}

// verificar se formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $comentario = $_POST["comentario"];

    if (!empty($comentario)) {
        if (inserirComentario($comentario)) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

$sql = "SELECT c.id, c.comentario, c.data_hora, COALESCE(l.likes, 0) AS likes
        FROM comentarios c
        LEFT JOIN (
            SELECT comentario_id, SUM(likes) AS likes
            FROM likes_comentario
            GROUP BY comentario_id
        ) l ON c.id = l.comentario_id
        ORDER BY likes DESC";

$result = $conn->query($sql);
?>
<!-- O HTML ESTÁ AQUI -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include 'blocos-html/head-inicio.html'; ?>
</head>

<body>
    <main>
        <?php include 'blocos-html/header-site.html'; ?>
        <?php include 'blocos-html/fala.html'; ?>
        <!-- ?php include 'blocos-html/pop-up-boas-vindas.html'; ? --->
        <?php include 'blocos-html/posts.html'; ?>
    </main>
</body>
<footer class="footer">
    <?php include 'blocos-html/footer-site.html'; ?>
</footer>

</html>

<!-- O HTML ESTÁ AQUI -->