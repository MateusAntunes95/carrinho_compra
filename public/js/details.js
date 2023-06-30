document.addEventListener("DOMContentLoaded", () => {
    const product_id = document.getElementById('product_id').value;
    const product_value = document.getElementById('product_value').value;
    document.getElementById('comprar').addEventListener('click', function () {

        var data = {
            product_id: product_id,
            product_value: product_value,
        };

        var jsonData = JSON.stringify(data);
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var xhr = new XMLHttpRequest();

        xhr.open("POST", "/carrinho/store", true);

        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("X-CSRF-Token", csrfToken);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert("Produto adicionado ao carrinho com sucesso");
                    window.location.href = "/carrinho";
                } else {
                    console.error("Ocorreu um erro na requisição: " + xhr.status);
                }
            }
        };

        xhr.send(jsonData);
    });
});
