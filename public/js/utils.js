document.addEventListener("DOMContentLoaded", () => {

});
function requisicaoAjax(url, metodo, dados, sucesso, erro) {
    console.log('heh');
    var xhr = new XMLHttpRequest();

    xhr.open(metodo, url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (sucesso && typeof sucesso === "function") {
                sucesso(xhr.responseText);
                }
                } else {
                if (erro && typeof erro === "function") {
                erro(xhr.status);
                }
            }
        }
    };

    xhr.send(JSON.stringify(dados));
}

