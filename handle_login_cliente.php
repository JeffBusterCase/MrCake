<?php
	require_once "bd/conexao.php";
	
	
	
	if(isset ($_POST) && !empty($_POST))
	{
		$email = $_POST['email'];
		$senha = $_POST['senha'];		
		
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
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
			if($email == $row['email'] && $senha == $row['senha'])
			{
				$sql = "UPDATE USUARIOS SET status = 1 WHERE email = '$email'";
				$stmt = sqlsrv_query( $conn, $sql );
				// TODO: Usar token, ex: Af4F4f3KK49 ou 242524. Na barra da URL ou como cache.
				echo "<script>window.location.replace('/adm_cli/index.php?email=$email');</script>";
			}
			else
			{
				echo "<script>alert('Usuário ou senha inválida');</script>";
			}
		}	

		sqlsrv_free_stmt( $stmt);
	}
	else
	{
		echo 'erro -> POST INVALIDO';
	}
	
?>