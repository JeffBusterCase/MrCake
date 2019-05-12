<?php
	require_once  "../function/function_php.php";
	
	
	
	$conn = new PDO("mysql:dbname=mrcake; host=localhost", "root", "");
	
		$email = 'Fernadolo11ok1@outlook.com1';
		$senha = '11';
		$stmt = $conn->prepare("SELECT senha FROM Clientes where senha = '$senha' AND where email = $email");
		$stmt-> execute();
		var_dump($stmt);
		$indice = 'senha';
		$result_senha =  Indice_1($stmt, $indice);//retorna a senha 
		echo "$result_senha";
		var_dump($result_senha);






	


		
?>