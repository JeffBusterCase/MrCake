<?php

	if(isset ($_POST) && !empty($_POST))
	{
		$email = $_POST['email'];
		$nome = $_POST['txtNomeP'];
		$descricao = $_POST['txtDescricaoP'];
		$preco = $_POST['txtPrecoP'];
		$imagem = $_POST['foto'];
		$preco =  str_replace(",",".",$preco);
		
		
		//echo "<script>alert('$preco');</script>";
		//echo "<script>alert('Funcionou');</script>";
		/*
		echo "<script>alert('$nome');</script>";
		echo "<script>alert('$descricao');</script>";
		echo "<script>alert('$preco');</script>";
		echo "<script>alert('$imagem');</script>";
		*/
		
		
		
		$sql = "SELECT id_origem FROM usuarios WHERE email = '$email'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

		if($stmt)
		{
			if ($stmt->rowCount() == 0)
			{
				echo "<script>alert('Usuário ou senha inválida');</script>";
			}

		}
		
		while( $row = $stmt->fetchAll(PDO::FETCH_ASSOC) )
		{
			$id_fornecedor = $row['id_origem'];
		}
		
		
		$sql = "insert into produtos(id_fornecedor, nome, descricao, preco) values ($id_fornecedor, '$nome', '$descricao', '$preco')"; //"('2', 'Teste', 'Teste', '10.00')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
		if($stmt)
		{			
			echo "<script>alert('Produto inserido com sucesso!');</script>";
		}
		else
		{
			echo "<script>alert('Algo deu errado!');</script>";
		}
	}
	else
	{
		echo "<script>alert('ha');</script>";
	}
	
?>