
<?PHP 

	require_once "bd/conexao.php";

	$id = 0;
	$email 		 = $_POST['txtEmail'];		
	$senha 		 = $_POST['txtSenha'];
	$nome_compl  = $_POST['txtNome'];		
	$nascimento  = $_POST['txtNascimento'];
	$cpf_1 		 = $cpf = $_POST['txtCPF'];
	$cpf 		 = str_replace("-","",$cpf);
	$cpf 		 = str_replace(".","",$cpf);
				 //$ddd = $_POST['txtDDD'];
	$tel 		 = $_POST['txtTelefone'];
	$tel 		 = str_replace("-","",$tel);
	$tel 		 = str_replace(" ","",$tel);
	$cel 		 = $_POST['txtCelular'];
	$cel 		 = str_replace("-","",$cel);
	$cel 		 = str_replace(" ","",$cel);


	$stmt = $conn->prepare("SELECT email FROM Clientes where email = '$email'");// conta a quantidade de chaves no banco de dados
	$stmt-> execute();
	$indice = 'email';
	$result_email = Indice_1($stmt, $indice);

	
	$stmt = $conn->prepare("SELECT CPF FROM Clientes where CPF = '$cpf_1'");// conta a quantidade de chaves no banco de dados
	$stmt-> execute();
	$indice = 'CPF';
	$result_cpf = Indice_1($stmt, $indice);

	if ($result_email != $email) {

		if ($result_cpf != $cpf_1 ) {

			$total = 'total';
			$stmt = $conn->prepare("SELECT COUNT(ID_Cliente) as $total FROM Clientes");// conta a quantidade de chaves no banco de dados
			$stmt-> execute();

			$id = Indice_1($stmt, $total);

			$id+=1;//soma mais um com o retorno do banco de dados
			$stmt = $conn->prepare("INSERT INTO CLIENTES VALUES (:ID_CLIENTE,:EMAIL, :SENHA,:CPF, :NOME_COMPL, :DATA_NASC, :TELEFONE, :CELULAR)");
			$stmt->bindParam(":ID_CLIENTE", $id);
			$stmt->bindParam(":EMAIL", $email);
			$stmt->bindParam(":SENHA", $senha);
			$stmt->bindParam(":CPF", $cpf_1);
			$stmt->bindParam(":NOME_COMPL", $nome_compl);
			$stmt->bindParam(":DATA_NASC", $nascimento);
			$stmt->bindParam(":TELEFONE", $tel);
			$stmt->bindParam(":CELULAR", $cel);
			$stmt->execute();
			
			echo "<script>alert('Cadastro efetuado com sucesso!');</script>";
		} else{
			echo "<script>alert('O CPF: $cpf_1, já possui cadastro!');</script>";
		}

			

		
	}else {
			echo "<script>alert('O e-mail: $email já existe, favor digitar um novo e-mail');</script>";

		}


	?>