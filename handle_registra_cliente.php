<?php
	require_once "bd/conexao.php";
	
	if(isset ($_POST) && !empty($_POST))
	{
		$email = $_POST['txtEmail'];		
		$senha = $_POST['txtSenha'];
		$nome = $_POST['txtNome'];		
		$nascimento = $_POST['txtNascimento'];
		$cpf = $_POST['txtCPF'];
		$cpf = str_replace("-","",$cpf);
		$cpf = str_replace(".","",$cpf);
		//$ddd = $_POST['txtDDD'];
		$tel = $_POST['txtTelefone'];
		$tel = str_replace("-","",$tel);
		$tel = str_replace(" ","",$tel);
		$cel = $_POST['txtCelular'];
		$cel = str_replace("-","",$cel);
		$cel = str_replace(" ","",$cel);
		
		
		/*
		echo "email = " . $email;
		
		echo "<br>Senha = " . $senha;
		echo "<br>Nome=" . $nome;
		echo "<br>nascimento=" . $nascimento;
		echo "<br>cpf=" . $cpf;
		//echo "<br>ddd=" . $ddd;
		echo "<br>tel=" . $tel;
		echo "<br>cel=" . $cel;
		*/
		
		
		
		$sql = "SELECT email FROM usuarios where email = '$email'";
		$stmt = sqlsrv_query( $conn, $sql );
		if($stmt)
		{			
			$rows = sqlsrv_has_rows( $stmt );
			if ($rows === false)
			{		

				$sql1 = "insert into clientes (nome, nascimento, telefone, celular) values ('$nome', '$nascimento', '$tel', '$cel')";
				$stmt1 = sqlsrv_query( $conn, $sql1 );
				
				$sql2 = "SELECT id_cliente FROM clientes where nome = '$nome'";
				$stmt2 = sqlsrv_query( $conn, $sql2 );
				while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) 
				{
					$id = $row['id_cliente'];
				}
				
				$sql3 = "insert into usuarios (id_origem, email, senha) values ('$id', '$email', '$senha')";
				$stmt3 = sqlsrv_query( $conn, $sql3 );
				
				
				
				echo "<script>alert('Cadastro efetuado com sucesso');</script>";
				
				sqlsrv_free_stmt( $stmt);
				sqlsrv_free_stmt( $stmt1);
				sqlsrv_free_stmt( $stmt2);
				sqlsrv_free_stmt( $stmt3);
			}

		}
		else
		{
			echo "<script>alert('O e-mail já existe, favor digitar um novo e-mail');</script>";
		}
		
		
		/*
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
		{
			if($email == $row['email'] && $senha == $row['senha'])
			{
				$sql = "update usuarios set status = 1 where email = '$email'";
				$stmt = sqlsrv_query( $conn, $sql );
							
				echo "<script>window.location.replace('/adm_cli/index.php?email=$email');</script>";
			}
			else
			{
				echo "<script>alert('Usuário ou senha inválida');</script>";
			  
			}
		}	
		
		*/
		
		
		
		
	}
	else
	{
		echo 'erro';
	}
	
?>