<?php	

	class sql
	{				
		public $senha;
		public $nf;
		public $rs;
		public $cnpj;
		public $tel;
		public $id_origem;
		public $preco;
		public $produto;
		public $descricao;
		
		
		
		public function adm()
		{
			//require_once "conexao.php";
			
			$serverName = "localhost\\SQLEXPRESS";


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
		}
		
		public function verifica($email)
		{
			global $senha;
			global $nf;
			global $rs;
			global $cnpj;
			global $tel;
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
			
			while( $row1 = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{				
				$row2 = $row1['status'];	
				$senha = $row1['senha']; 				
				
				
			}
			
			if($row2 != 1)
			{
				header("location:logout.php");
			}
			
			
			sqlsrv_free_stmt( $stmt);
			
		}
		
		public function dados($email)
		{
		
			global $senha;
			global $nf;
			global $rs;
			global $cnpj;
			global $tel;
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
			
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{				
				$senha = $row['senha']; 
				$id_origem = $row['id_origem'];
			}
			
			$sql1 = "SELECT * FROM fornecedores where id_fornecedor = '$id_origem'";
			$stmt1 = sqlsrv_query( $conn, $sql1 );			
			if( $stmt1 === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
				header("location:logout.php");
			}		
			
			while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) 
			{				
				$nf = $row1['nome_fantasia'];
				$rs = $row1['rasao_social'];				
				$cnpj = $row1['cnpj'];
				$tel = $row1['telefone'];
				
			}
			
			
			sqlsrv_free_stmt( $stmt);
			sqlsrv_free_stmt( $stmt1);
		}
		
		public function produtos($e)
		{
			
			echo "<script>alert('$e');</script>";
			/*
			$serverName = "localhost\\SQLEXPRESS";
			$connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
			$conn = sqlsrv_connect( $serverName, $connectionInfo );
			if( $conn === false ) 
			{
				die( print_r( sqlsrv_errors(), true));
			}	
			
			$sql = "SELECT id_fornecedor FROM fornecedores where email = '$email'";
			$stmt = sqlsrv_query( $conn, $sql );					
			
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{				
				$id_origem = $row['id_fornecedor'];
			}	
			
			return $id_origem;
			
			sqlsrv_free_stmt( $stmt);			
			
			*/
		}
		
		public function modalEditar($i)
		{
			global $preco;
			global $produto;
			global $descricao;
			
			$serverName = "localhost\\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
			$conn = sqlsrv_connect( $serverName, $connectionInfo );
			if( $conn === false ) 
			{
				die( print_r( sqlsrv_errors(), true));
			}	
			
			$sql = "SELECT nome, descricao, preco FROM produtos where id_produto = '$i'";
			$stmt = sqlsrv_query( $conn, $sql );	
			if( $stmt === false) 
			{
				die( print_r( sqlsrv_errors(), true) );
				
			}	
			
			while( $produtos = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{				
				$preco = $produtos['preco'];
				$produto = $produtos['nome'];
				$descricao = $produtos['descricao'];
			}			
			
			//sqlsrv_free_stmt( $stmt); );
		}
        private function get_historico_compras($id_fornecedor, $status){
            $serverName = "localhost\\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
            $conn = sqlsrv_connect( $serverName, $connectionInfo );
            if( $conn === false )
            {
                die( print_r( sqlsrv_errors(), true));
            }

            $query = "SELECT * FROM Pedidos WHERE id_cliente = $id_cliente"; // aqui status = 1 significa recebido
            $query_result = sqlsrv_query($conn, $query);

            if($query_result === false){
                die(print_r(sqlsrv_errors(), true));
                header("location:logout.php?pq=usuario");
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