// Função para fechar o pop-up
function fecharPopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
}

// Espera o documento ser carregado
document.addEventListener("DOMContentLoaded", function() {
    var popup = document.getElementById("popup");
    popup.style.display = "block";
});