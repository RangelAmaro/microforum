$(document).ready(function() {
    // Enviar o comentário usando AJAX
    $('#formulario').submit(function(e) {
        e.preventDefault(); // Impede o envio padrão do formulário

        var comentario = $('#comentario').val();

        // Enviar os dados para o arquivo de destino usando AJAX
        $.ajax({
            type: 'POST',
            url: 'enviar_comentario.php', // Arquivo PHP para processar o envio do comentário
            data: { comentario: comentario },
            success: function(response) {
                // Ação a ser executada em caso de sucesso
                alert('Comentário enviado com sucesso!');

                // Limpar o campo de comentário
                $('#comentario').val('');

                // Atualizar a lista de comentários (opcional)
                atualizarComentarios();
            },
            error: function() {
                // Ação a ser executada em caso de erro
                alert('Erro ao enviar o comentáriou.');
            }
        });
    });

    // Chamar a função de atualização de comentários ao carregar a página (opcional)
    atualizarComentarios();
});