<?php
	$serverName = "localhost\\SQLEXPRESS";
	$connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
	$conn = sqlsrv_connect( $serverName, $connectionInfo );
	if( $conn === false ) 
	{
		die( print_r( sqlsrv_errors(), true));
	}	
	
	$sql = "update usuarios set tempo = 0 where codigo = 2";
	$stmt = sqlsrv_query( $conn, $sql );
	
?>