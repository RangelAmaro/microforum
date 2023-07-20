<?php
session_start();

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // Ler o arquivo CSV de usuários
    $usuarios = [];
    if (($handle = fopen("usuarios.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $usuarios[$data[0]] = $data[1];
        }
        fclose($handle);
    }

    // Verificar se as credenciais de login estão corretas
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