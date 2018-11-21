<?php
	
	$serverName = "";
	$connectionInfo = array( "Database"=>"mrcake", "UID"=>"syst", "PWD"=>"Trab@!123@!");
	$conn = sqlsrv_connect( $serverName, $connectionInfo );
	if( $conn === false ) 
	{
		die( print_r( sqlsrv_errors(), true));
	}	
	
?>