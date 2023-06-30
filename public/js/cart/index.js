document.addEventListener("DOMContentLoaded", () => {
    const elementos = document.querySelectorAll(".remove-produto");

    elementos.forEach((elemento) => {
      elemento.addEventListener("click", removerProduto);
    });

    function removerProduto(e) {
        const request_id = e.target.dataset.idRequest;
        const product_id = e.target.dataset.idProduct;
        const request_product_id = e.target.dataset.idRequestproduct;
        console.log(e.target.dataset)

        var data = {
            product_id: product_id,
            request_id: request_id,
            request_product_id: request_product_id,
        };

        requisicaoAjax("/carrinho/destroy", "DELETE", data, function(resposta) {
            alert(resposta);
            window.location.href = "/carrinho";
          }, function(erro) {
            console.error("Ocorreu um erro na requisição: " + erro);
          });
    }
});
