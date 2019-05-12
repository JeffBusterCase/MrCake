<?php 
$conn = new PDO("mysql:dbname=mrcake; host=localhost", "root", "");
	function Indice_1 ($stmt, $indice){ 
		$resultado = $stmt-> fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $key => $value) {
		return $result = $value[$indice];//retorna 1 indice
		}
	}



		$email = 'Fernadolo11ok1@outlook.com1';
		$senha = '11';
		$stmt = $conn->prepare("SELECT * FROM clientes where senha = '$senha' AND email = '$email' ");
		$stmt-> execute();
		$indice_Senha = 'Senha';
		$indice_Email= 'Email';
		$result; 
		$resultado = $stmt-> fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $key => $value) {
		$result = $value[$indice_Senha];
		$resultemail = $value[$indice_Email];
		}
		echo "$result ///////////////////////////////////////////////// $resultemail";


	
 ?>