<?php
	class sql
	{		
		
		public $senha;
		public $cpf;
		public $nome;
		public $nascimento;
		public $tel;
		public $cel;
		public $id_origem;
		
		public function adm()
		{
			//require_once "conexao.php";


			if( $conn === false ) 
			{
				die( print_r( sqlsrv_errors(), true));
			}	
			
			$sql = "SELECT * FROM administradores";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			if( $stmt === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
			}
			
			while( $row = $stmt->fetchAll(PDO::FETCH_ASSOC) )
			{
				echo $row['codigo'].", ".$row['nome']."<br />";
			}

		}
		
		public function verifica($email)
		{
			$sql = "SELECT status FROM usuarios where email = '$email'";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			if( $stmt === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
				header("location:logout.php");
			}			
			
			$row1 = Indice_1($stmt);
			$row2 = $row1['status'];
			
			if($row2 != 1)
			{
				header("location:logout.php");
			}
			//echo "<script>alert('$row2');</script>";
			
			/*
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{				
				if($row['status'] != 1)
				{
					header("location:logout.php");			
				}
				//echo $row['status'];				
			}
			*/
		}
		public function dados($email)
		{
		
			
			global $senha;
			global $cpf;
			global $nome;
			global $nascimento;
			global $tel;
			global $cel;
			global $id_origem;
			
			$sql = "SELECT * FROM usuarios where email = '$email'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
			if( $stmt === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
				header("location:logout.php");
			}		
			//echo "<script>alert('$email');</script>";
			while( $row = $stmt->fetchAll(PDO::FETCH_ASSOC) )
			{				
				$senha = $row['senha']; 
				$id_origem = $row['id_origem'];
			}
			
			$sql1 = "SELECT * FROM clientes where id_cliente = '$id_origem'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
			if( $stmt1 === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
				header("location:logout.php");
			}		
			
			while( $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC) )
			{				
				$cpf = $row1['cpf'];
				$nome = $row1['nome'];				
				//$nascimento = $row1['nascimento'];
				//$nascimento = "1987-04-10";
				$tel = $row1['telefone'];
				$cel = $row1['celular'];
			}

		}
		private function get_historico_compras($id_cliente, $status){

            $query = "SELECT * FROM Pedidos WHERE id_cliente = $id_cliente AND status = $status"; // aqui status = 1 significa recebido
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            if($query_result === false){
                die(print_r(sqlsrv_errors(), true));
                header("location:logout.php");
            }
            $results = array();

            while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                array_push($results, $row);
            }

            return $results;
        }
		public function get_historico_compras_em_aguardo($id_cliente){
		    return $this->get_historico_compras($id_cliente, 0);
        }
		public function get_historico_compras_entregues($id_cliente){
            return $this->get_historico_compras($id_cliente, 1);
        }
	}
?>