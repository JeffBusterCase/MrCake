<?php

    require_once("\bd\conexao.php");

    // Recebe valores
    $token_do_cliente = $_POST["TOKEN"];
    $id_produto = (int)$_POST["txtId"]; // fornecedor sera pego pelo produto no bd
    $id_cliente = (int)$_POST["txtIdCliente"];
    $quantidade = (int)$_POST['txtQuantidade'];
    $endereco_entrega = $_POST["txtIdEndereco"]; // ==  o proprio se for pegar na empresa, se não, o da empresa em sí

    // cria pedido no bd | status = 0 -> vai ser 1 quando for entregue.
    $stmt = "
            INSERT INTO Pedidos(num_pedido, id_cliente, id_produto, status, cod_endereco_entrega)
            VALUES ($quantidade, $id_cliente, $id_produto, 0, $id_endereco)
        ";
    $query_fornecedor = sqlsrv_query($conn, $stmt);
    if($query_fornecedor){
        echo "<script>
                    alert('Pedido efetuado com sucesso');
                    location.href = '/Area_Clientes.php?token=$token_do_cliente';
                </script>";
    } else {
        echo "<script>
                alert('Desculpe-me seu pedido não pode ser efetuado :C');
                location.href = '/Area_Clientes.php?token=$token_do_cliente';
                </script>";
    }


