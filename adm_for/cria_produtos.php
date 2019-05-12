<?php

    echo "<script>alert('chegou aqui');</script>";

	$serverName = "localhost\\SQLEXPRESS";
	$connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
	$conn = sqlsrv_connect( $serverName, $connectionInfo );
	if( $conn === false ) 
	{
		die( print_r( sqlsrv_errors(), true));
	}	
	
	if(isset ($_POST) && !empty($_POST))
	{
		$email = $_POST['email'];
		$nome = $_POST['txtNomeP'];
		$descricao = $_POST['txtDescricaoP'];
		$preco = $_POST['txtPrecoP'];
		$imagem = $_POST['txtFotoP'];
		$ingredientes = $_POST['txtIngredientesP'];
		$preco =  str_replace(",",".",$preco);
		
		
		//echo "<script>alert('$preco');</script>";
		/*
		echo "<script>alert('$nome');</script>";
		echo "<script>alert('$descricao');</script>";
		echo "<script>alert('$preco');</script>";
		echo "<script>alert('$imagem');</script>";
		*/

		$sql = "SELECT id_origem FROM usuarios WHERE email = '$email'";
		$stmt = sqlsrv_query( $conn, $sql );
		if($stmt)
		{			
			$rows = sqlsrv_has_rows( $stmt );
			if ($rows === false)
			{							
				echo "<script>alert('Usuário ou senha inválida');</script>";
			}
			
		}
		
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
		{
			$id_fornecedor = $row['id_origem'];
		}

		$sql = "SELECT COUNT(*) N FROM Produtos";
		$stmt = sqlsrv_query($conn, $sql);
		if($stmt)
        {
            $rows = sqlsrv_has_rows( $stmt );
            if (!$rows)
            {
                echo "<script>alert('Erro Salvando imagem')</script>";
            }
        }

        echo "<script>alert('antes de \$imgfile')</script>";

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $file_name = 'bolo_' . $row['N'] . '.jpg';

		$imgfile = file_put_contents('/Imagens/Produtos/' . $file_name, $imagem);

		echo "<script>alert('depois de \$imgfile')</script>";

		$sql1 = "insert into produtos(id_fornecedor, nome, descricao, preco, imagem) values ($id_fornecedor, '$nome', '$descricao', '$preco', 'Produtos/$file_name')";
		$stmt1 = sqlsrv_query( $conn, $sql1 );
		if($stmt1)
		{			
			echo "<script>alert('Produto inserido com sucesso!');</script>";

			$sql = "SELECT MAX(id_produto) max FROM Produtos";
            $stmt = sqlsrv_query( $conn, $sql );

            if($stmt){
                $id_produto = null;
                while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                {
                    $id_produto = $row['max'];
                }

                $ingredientes = explode(",", $ingredientes);

                foreach($ingredientes as $ingrediente)
                {
                    $sql = "INSERT INTO Ingredientes (id_produto, descricao)" .
                        "VALUES($id_produto, '$ingrediente')";
                    $stmt = sqlsrv_query( $conn, $sql);
                }

                if(!$stmt) {
                    echo "<script>alert('ERRO INSERINDO INGREDIENTES')</script>";
                } else {
                    echo "<script>document.querySelector('#close_cria_produto').click();</script>";
                }

            } else {
                echo "<script>alert('ERRO INSERINDO INGREDIENTES');</script>";
            }
		}
		else
		{
			echo "<script>alert('Algo deu errado!');</script>";
		}		

		sqlsrv_free_stmt( $stmt);
		sqlsrv_free_stmt( $stmt1);		
	}
	else
	{
		echo "<script>alert('ha');</script>";
	}
	
?>