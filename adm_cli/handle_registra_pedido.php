<?php

    require_once "bd\conexao.php";

    // Recebe valores
    $id_produto = $_POST['id_produto']; // fornecedor sera pego pelo produto no bd
    $id_cliente = $_POST["id_cliente"];
    $quantidade = $_POST['quantidade'];
    $id_endereco = 1; // ==  o proprio se for pegar na empresa, se não, o da empresa em sí

    $con = getConnection();

    // cria pedido no bd | status = 0 -> vai ser 1 quando for entregue.
    $stmt = "
            INSERT INTO Pedidos(num_pedido, id_cliente, id_produto, status, cod_endereco_entrega)
            VALUES ($quantidade, $id_cliente, $id_produto, 0, $id_endereco)
    ";



    $query_fornecedor = sqlsrv_query($con, $stmt);
    if($query_fornecedor){
        echo 'Compra efetuada com sucesso!';
    } else {
        echo 'Desculpe-me seu pedido não pode ser efetuado :C. Já tentou verificar se o cabo de rede esta plugado?';
    }


