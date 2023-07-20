<?php
//conectar com o banco mysql
require_once '../config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION["usuario"])) {
    // Verificar se o formulário de login foi enviado
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        // Incluir o arquivo de usuários
        include('usuarios.csv');

        // Verificar as credenciais de login
        if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $senha) {
            $_SESSION["usuario"] = $usuario;
            header("Location: index.php");
            exit();
        } else {
            $mensagemErro = "Usuário ou senha inválidos.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($mensagemErro)) { ?>
        <p><?php echo $mensagemErro; ?></p>
    <?php } ?>

    <form method="post" action="">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>

        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>

<?php
} else {
    // Se o usuário já está logado, exiba o conteúdo da área de administração
    // Restante do conteúdo da área de administração...
    echo "<h1>Painel de Administração</h1>";
    echo "<p>Bem-vindo, " . $_SESSION["usuario"] . "!</p>";
    // Resto do conteúdo da área de administração...
}
?>
<?php
// Verificar se o usuário está logado
if (!isset($_SESSION["usuario"])) {
    // Redirecionar para a página de login
    header("Location: login.php");
    exit();
}

// Verificar se o formulário de logout foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["logout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
    <form method="post" action="">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>





<?php
// Função para remover um comentário e suas curtidas
function removerComentario($comentarioId) {
    global $conn;

    // Remover as curtidas associadas ao comentário
    $sqlRemoverCurtidas = "DELETE FROM likes_comentario WHERE comentario_id = $comentarioId";

    if ($conn->query($sqlRemoverCurtidas) === TRUE) {
        // Remover o comentário
        $sqlRemoverComentario = "DELETE FROM comentarios WHERE id = $comentarioId";

        if ($conn->query($sqlRemoverComentario) === TRUE) {
            return true;
        } else {
            echo "Erro ao remover comentário: " . $conn->error;
        }
    } else {
        echo "Erro ao remover as curtidas associadas ao comentário: " . $conn->error;
    }

    return false;
}

// Verificar se o formulário de remoção foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["remover"])) {
    $comentarioId = $_POST["comentario_id"];

    if (!empty($comentarioId)) {
        if (removerComentario($comentarioId)) {
            echo "Comentário removido com sucesso!";
        }
    }
}

// Verificar se o formulário de busca foi enviado
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["buscar"])) {
    $termoBusca = $_GET["termo"];

    if (!empty($termoBusca)) {
        $sql = "SELECT c.id, c.comentario, c.data_hora, COALESCE(l.likes, 0) AS likes
                FROM comentarios c
                LEFT JOIN (
                    SELECT comentario_id, SUM(likes) AS likes
                    FROM likes_comentario
                    GROUP BY comentario_id
                ) l ON c.id = l.comentario_id
                WHERE c.comentario LIKE '%$termoBusca%'
                ORDER BY c.data_hora DESC";
    } else {
        $sql = "SELECT c.id, c.comentario, c.data_hora, COALESCE(l.likes, 0) AS likes
                FROM comentarios c
                LEFT JOIN (
                    SELECT comentario_id, SUM(likes) AS likes
                    FROM likes_comentario
                    GROUP BY comentario_id
                ) l ON c.id = l.comentario_id
                ORDER BY c.data_hora DESC";
    }
} else {
    $sql = "SELECT c.id, c.comentario, c.data_hora, COALESCE(l.likes, 0) AS likes
            FROM comentarios c
            LEFT JOIN (
                SELECT comentario_id, SUM(likes) AS likes
                FROM likes_comentario
                GROUP BY comentario_id
            ) l ON c.id = l.comentario_id
            ORDER BY c.data_hora DESC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Remover Comentários</h2>

    <form method="post" action="">
        <label for="comentario_id">ID do Comentário:</label>
        <input type="number" name="comentario_id" id="comentario_id" required>
        <input type="submit" name="remover" value="Remover">
    </form>

    <h2>Buscar Comentários</h2>

    <form method="get" action="">
        <label for="termo">Termo de Busca:</label>
        <input type="text" name="termo" id="termo">
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <h2>Comentários</h2>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p><strong>ID:</strong> " . $row["id"] . "</p>";
            echo "<p><strong>Comentário:</strong> " . $row["comentario"] . "</p>";
            echo "<p><strong>Data/Hora:</strong> " . $row["data_hora"] . "</p>";
            echo "<p><strong>Likes:</strong> " . $row["likes"] . "</p>";
            echo "</div><hr>";
        }
    } else {
        echo "Nenhum comentário encontrado.";
    }

    $conn->close();
    ?>
</body>
</html>

