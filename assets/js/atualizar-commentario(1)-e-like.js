// Função para atualizar os comentários
function atualizarComentarios() {
    $.ajax({
        url: 'listar_comentarios.php',
        type: 'GET',
        success: function(response) {
            $('#comentarios').html(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

// Função para adicionar um like
function adicionarLike(comentarioId) {
    $.ajax({
        url: 'like.php',
        type: 'GET',
        data: { id: comentarioId },
        success: function(response) {
            alert('Obrigado pela curtida :)');
            atualizarComentarios();
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

// Espera o documento ser carregado
$(document).ready(function() {
    atualizarComentarios();
});