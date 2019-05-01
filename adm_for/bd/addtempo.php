<?php
	$serverName = "localhost\\SQLEXPRESS";
	$connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
	$conn = sqlsrv_connect( $serverName, $connectionInfo );
	if( $conn === false ) 
	{
		die( print_r( sqlsrv_errors(), true));
	}	
	
	$sql = "SELECT * FROM usuarios";
	$stmt = sqlsrv_query( $conn, $sql );
	if( $stmt === false) 
	{
		die( print_r( sqlsrv_errors(), true) );
	}

	
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
	{		
		$codigo = $row['codigo'];
		$tempo = $row['tempo'];
		$tempo = $tempo + 10;
		$status = $row['status'];
		if($tempo > 50)
		{
			$sql = "update usuarios set status = 0, tempo = 0 where codigo = $codigo";
			$stmt = sqlsrv_query( $conn, $sql );
		}
		else if($status == 1 && $tempo <=50)
		{
			$sql = "update usuarios set tempo = $tempo where codigo = $codigo";
			$stmt = sqlsrv_query( $conn, $sql );
		}		
	}
	
	sqlsrv_free_stmt( $stmt);
	
?>