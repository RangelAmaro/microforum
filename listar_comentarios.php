<?php
// conexão com o banco
require_once 'config.php';

// numero máximo de comentários por página
$comentariosPorPagina = 10;

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $comentariosPorPagina;

// consulta

$sql = "SELECT c.id, c.comentario, c.data_hora, COALESCE(l.likes, 0) AS likes
FROM comentarios c
LEFT JOIN (
    SELECT comentario_id, SUM(likes) AS likes
    FROM likes_comentario
    GROUP BY comentario_id
) l ON c.id = l.comentario_id
 ORDER BY likes DESC, c.data_hora DESC LIMIT $inicio, $comentariosPorPagina";
 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='comentario-single' >";
        echo "<div class='perfil-comentario' >";
        echo "<img class='icon-pefil' src='assets/img/icon.png' alt='perfil'>";
        echo "<p><strong></strong> " . $row["comentario"] . "</p>";
        echo "</div>";
        echo "<hr class='hr-comentario' ><div class='comentario-infos' >";
        echo "<p><strong>" . $row["likes"] . " Curtidas</strong></p>";
        echo "<p class='data-hora-comentario' ><strong></strong> " . $row["data_hora"] . "</p>";
        echo "</div>";
        echo "<button class='curtir' onclick=\"adicionarLike(" . $row["id"] . ")\">CURTIR ESSE POST</button>";
        echo "</div>";
    }
} else {
    echo "Nenhum comentário encontrado.";
}

// calculo
$sqlTotal = "SELECT COUNT(*) AS total FROM comentarios";
$resultTotal = $conn->query($sqlTotal);
$rowTotal = $resultTotal->fetch_assoc();
$totalComentarios = $rowTotal['total'];
$totalPaginas = ceil($totalComentarios / $comentariosPorPagina);

// links de paginação
echo "<p style='
margin-left: 10px;
'' >Veja mais posts</p>";
echo "<div class='paginacao'>";
for ($i = 1; $i <= $totalPaginas; $i++) {
    echo "<a href='#' class='pagina-link' data-pagina='$i'>$i</a> ";
}
echo "</div>";

$conn->close();
?>