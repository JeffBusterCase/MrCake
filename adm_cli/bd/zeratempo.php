<?php
	$conn = new PDO("mysql:dbname=mrcake; host=localhost", "root", ""); 

	if( $conn === false ) 
	{
		die( print_r( errors(), true));
	}	
	
	//$sql = "update usuarios set tempo = 0 where codigo = 2";
	//$stmt = sqlsrv_query( $conn, $sql );
	
?>