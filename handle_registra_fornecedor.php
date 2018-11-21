<?php
    require_once "bd/conexao.php";//$conn

    $estagio = "";

    if(isset ($_POST) && !empty($_POST)) 
	{

        $email = $_POST["txtEmail"];
        $senha = $_POST["txtSenha"];
        $razao_social = $_POST["txtRazaoSocial"];
        $nome_fantasia = $_POST["txtNomeFantasia"];
        $cnpj = $_POST["txtCNPJ"];
		$telefone = $_POST["txtTelefone"];
			
		/*
        // Para remover os . e o -
        preg_match_all('!\d+!', $cnpj, $matches);
        $cnpj = implode('', $matches[0]);

        $telefone = $_POST["txtTelefone"];
        preg_match_all('!\d+!', $telefone, $matches);
        $telefone = implode('', $matches[0]);

        $tipo_origem = 3;

        // Para não registrar conta com email já presente no banco (usuário existente)
        $sql_check = "SELECT email FROM Usuarios where email = '$email'";
        $query_result = sqlsrv_query($conn, $sql_check);
        if ($query_result) {
            if (sqlsrv_has_rows($query_result)) {
                echo "<script>
                alert('Usuário já registrado com email ' + $email + \"\n favor inserir outro email ou fazer login.\");
            </script>";
                return;
            }

            $sql_insert_fornecedor = "INSERT INTO Fornecedores (cnpj, telefone, razao_social, nome_fantasia) 
                                VALUES ($cnpj, $telefone, '$razao_social', '$nome_fantasia')";
            $sql_insert_usuarios = "INSERT INTO Usuarios (id_origem, tipo_origem, email, senha)
                                VALUES (id_fornecedor, $tipo_origem, '$email', '$senha')
                                
                                ";

            $estagio = "INSERT_FORNECEDOR";
            $result_insert_fornecedor = sqlsrv_query($conn, $sql_insert_fornecedor);

            if ($result_insert_fornecedor !== false) {
                $estagio = "INSERT_USUARIOS";
                $result_insert_usuarios = sqlsrv_query($conn, $sql_insert_usuarios);
                if ($result_insert_usuarios !== false) {
                    echo "<script>
                    alert('Registrado com sucesso!');
                </script>";

                    return;
                }
            }
            echo "<style>
            body {
                font-family: monospace;
                font-size: 15px;
            }
        </style>";
            if (($errors = sqlsrv_errors()) != null) {
                foreach ($errors as $error) {
                    echo "SQLSTATE: " . $error['SQLSTATE'] . "</br>";
                    echo "\n code: " . $error['code'] . "</br>";
                    echo "\n message: " . $error['message'] . "</br>";
                }
                echo "(App) Estagio: $estagio";
                echo "(App) SQL INSERT FORNECEDOR: " . $sql_insert_fornecedor;
                echo "(App) SQL INSERT USUARIO   : " . $sql_insert_usuarios;
            }
        }
    } else {
        echo "Algo deu errado :c";
        foreach($_POST as $var){
            echo $var;
        }
		*/
	
		$sql = "SELECT email FROM usuarios where email = '$email'";
		$stmt = sqlsrv_query( $conn, $sql );
		
		//echo "<script>alert('$email');</script>";
		if($stmt)
		{			
			$rows = sqlsrv_has_rows( $stmt );
			if ($rows === false)
			{		

				$sql1 = "insert into fornecedores (cnpj, razao_social, nome_fantasia, telefone) values ('$cnpj', '$razao_social', '$nome_fantasia', '$telefone')";
				$stmt1 = sqlsrv_query( $conn, $sql1 );
				
				$sql2 = "SELECT id_fornecedor FROM fornecedores where cnpj = '$cnpj'";
				$stmt2 = sqlsrv_query( $conn, $sql2 );
				while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) 
				{
					$id = $row['id_fornecedor'];
				}
				
				$sql3 = "insert into usuarios (id_origem, email, senha) values ('$id', '$email', '$senha')";
				$stmt3 = sqlsrv_query( $conn, $sql3 );
				
				
				
				echo "<script>alert('Cadastro efetuado com sucesso');</script>";
				
				sqlsrv_free_stmt( $stmt);
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

		sqlsrv_free_stmt( $stmt);
		
		*/
	}
	else
	{
		echo 'erro';
	}	