<?php
    	// vou mudar aqui.

	$serverName = "localhost\\SQLEXPRESS";
	$connectionInfo = array( "Database"=>"mrcake", "UID"=>"sa", "PWD"=>"Rodrigo321");
	$conn = sqlsrv_connect( $serverName, $connectionInfo );
	if( $conn === false ) {
        die(print_r(sqlsrv_errors(), true));
    }

    function getConnection()
    {

        $serverName = "localhost\\SQLEXPRESS";
        $connectionInfo = array("Database" => "mrcake", "UID" => "sa", "PWD" => "Rodrigo321");
        $_conn = sqlsrv_connect($serverName, $connectionInfo);
        if ($_conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return $_conn;
        // feche ela manualmente
    }
    function fetch($results){
	    return sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC);
    }
?>