POJETO MICRO FORUM ANONIMO

PHP + MYSQL

Apenas uma página que você adiciona e ve os comentarios adicionados, SEM LOGIM e SEM FILTRO
Com um painel de adiministração /admin para poder remover os comentários, precisa de login para acessar, esse login esta no documento usuarios.csv

Funções:
-adicionar comentario{
    um input de texto para o banco de dados
}

-adicionar like{
    interage com os comentários adicionas, adiciona likes 1 por 1 Sem precisar fazer login e sem limite por usuário
}

-listar comentarios{
    procura todos os comentarios do banco e retorna com datatime numero de likes e função de adicionar likes ao post, possui paginação (limite de comentários por pagina para melhorar perfomace do site), a adição de like é instantãne e não precisa recarregar a pagina e usa o sistema AJAX
}

-painel de adiministração{
    sistema com login e logout para ver todos os comentãrios do banco, possui um buscador que busca os comentários pelo conteudo texto e tem uma fuçao de excluir comentários pelo id deles
}#   m i c r o f o r u m  
 