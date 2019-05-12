<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bd/conexao.php";//$conn

    $estagio = "";

    if(isset ($_POST) && !empty($_POST)) 
	{

        $email = $_POST["txtUsuario"];
        $senha = $_POST["txtSenha"];
        $razao_social = $_POST["txtRazaoSocial"];
        $nome_fantasia = $_POST["txtNomeFantasia"];
        $cnpj = $_POST["txtCNPJ"];
		$telefone = $_POST["txtTelefone"];
		
		echo "<script>alert('$email');</script>";
		
		/*
		
		$sql = "update fornecedores set cnpj = '$cnpj', razao_social = '$razao_social', nome_fantasia = '$nome_fantasia', telefone = '$telefone' where email = '$email'";
		$stmt = sqlsrv_query( $conn, $sql );
		
		//echo "<script>alert('$email');</script>";
		if($stmt)
		{						
			echo "<script>alert('Cadastro efetuado com sucesso');</script>";			
			sqlsrv_free_stmt( $stmt);
		}
		else
		{
			*/
			//echo "<script>alert('Erro ao alterar');</script>";
		//}		
	}
	else
	{
		echo "<script>alert('erro');</script>";
	}	