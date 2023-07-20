$(document).ready(function() {
    // Função para atualizar a lista de comentários
    function atualizarComentarios(pagina) {
        $.ajax({
            type: 'GET',
            url: 'listar_comentarios.php', // Arquivo PHP para obter a lista de comentários atualizada
            data: { pagina: pagina },
            success: function(response) {
                // Atualizar a área de exibição dos comentários
                $('#comentarios').html(response);
            },
            error: function() {
                alert('Erro ao obter a lista de comentários.');
            }
        });
    }

    // Chamar a função de atualização de comentários ao carregar a página
    atualizarComentarios(1);

    // Atualizar os comentários ao clicar nos links de páginação
    $(document).on('click', '.pagina-link', function(e) {
        e.preventDefault();
        var pagina = $(this).data('pagina');
        atualizarComentarios(pagina);
    });

    // Atualizar os comentários ao submeter o formulário de pesquisa
    $('#form-pesquisa').submit(function(e) {
        e.preventDefault();
        var pagina = 1;
        var pesquisa = $('#pesquisa').val();
        atualizarComentarios(pagina, pesquisa);
    });

});