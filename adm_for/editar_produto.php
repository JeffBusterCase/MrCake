<?php
	
	$serverName = "";
	$connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Let_22livre@");
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
		
		
		$sql1 = "update produtos set nome = '$nome', descricao = '$descricao', preco = '$preco' where id_fornecedor = $id_fornecedor";
		$stmt1 = sqlsrv_query( $conn, $sql1 );
		if($stmt1)
		{			
			echo "<script>alert('Produto editado com sucesso!');</script>";
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