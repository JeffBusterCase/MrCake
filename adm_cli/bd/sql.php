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
			
			$serverName = "localhost\\SQLEXPRESS";// bem seguro
            $connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
			$conn = sqlsrv_connect( $serverName, $connectionInfo );
			if( $conn === false ) 
			{
				die( print_r( sqlsrv_errors(), true));
			}	
			
			$sql = "SELECT * FROM administradores";
			$stmt = sqlsrv_query( $conn, $sql );
			if( $stmt === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
			}
			
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{
				echo $row['codigo'].", ".$row['nome']."<br />";
			}
			
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
		}
		
		public function verifica($email)
		{
			$serverName = "localhost\\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
			$conn = sqlsrv_connect( $serverName, $connectionInfo );
			if( $conn === false ) 
			{
				die( print_r( sqlsrv_errors(), true));
			}	
			
			$sql = "SELECT status FROM usuarios where email = '$email'";
			$stmt = sqlsrv_query( $conn, $sql );			
			if( $stmt === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
				header("location:logout.php");
			}			
			
			$row1 = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
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
			
			sqlsrv_free_stmt( $stmt);
            sqlsrv_close($conn);
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
		
			$serverName = "localhost\\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
			$conn = sqlsrv_connect( $serverName, $connectionInfo );
			if( $conn === false ) 
			{
				die( print_r( sqlsrv_errors(), true));
			}	
			
			$sql = "SELECT * FROM usuarios where email = '$email'";
			$stmt = sqlsrv_query( $conn, $sql );			
			if( $stmt === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
				header("location:logout.php");
			}		
			//echo "<script>alert('$email');</script>";
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{				
				$senha = $row['senha']; 
				$id_origem = $row['id_origem'];
				
				
			}
			
			$sql1 = "SELECT * FROM clientes where id_cliente = '$id_origem'";
			$stmt1 = sqlsrv_query( $conn, $sql1 );			
			if( $stmt1 === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
				header("location:logout.php");
			}		
			
			while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
			{				
				$cpf = $row1['cpf'];
				$nome = $row1['nome'];				
				//$nascimento = $row1['nascimento'];
				//$nascimento = "1987-04-10";
				$tel = $row1['telefone'];
				$cel = $row1['celular'];
			}
			
			
			sqlsrv_free_stmt( $stmt1);
			sqlsrv_free_stmt( $stmt);
            sqlsrv_close($conn);
		}
		private function get_historico_compras($id_cliente, $status){
            $serverName = "localhost\\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
            $conn = sqlsrv_connect( $serverName, $connectionInfo );
            if( $conn === false )
            {
                die( print_r( sqlsrv_errors(), true));
            }

            $query = "SELECT * FROM Pedidos WHERE id_cliente = $id_cliente AND status = $status"; // aqui status = 1 significa recebido
            $query_result = sqlsrv_query($conn, $query);

            if($query_result === false){
                die(print_r(sqlsrv_errors(), true));
                header("location:logout.php");
            }
            $results = array();

            while($row = sqlsrv_fetch_array($query_result, SQLSRV_FETCH_ASSOC)){
                array_push($results, $row);
            }

            return $results;

            sqlsrv_close($conn);
        }
		public function get_historico_compras_em_aguardo($id_cliente){
		    return $this->get_historico_compras($id_cliente, 0);
        }
		public function get_historico_compras_entregues($id_cliente){
            return $this->get_historico_compras($id_cliente, 1);
        }
	}
	
?>