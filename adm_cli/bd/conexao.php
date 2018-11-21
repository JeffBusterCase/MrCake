<?php
	
	$serverName = "";
	$connectionInfo = array( "Database"=>"mrcake", "UID"=>"syst", "PWD"=>"Trab@!123@!");
	$conn = sqlsrv_connect( $serverName, $connectionInfo );
	if( $conn === false ) {
        die(print_r(sqlsrv_errors(), true));
    }

    function querySQL($query_string) {
        $serverName = "";
        $connectionInfo = array( "Database"=>"mrcake", "UID"=>"syst", "PWD"=>"Trab@!123@!");
        $_conn = sqlsrv_connect( $serverName, $connectionInfo );
        if( $_conn === false ) {
            die(print_r(sqlsrv_errors(), true));
        }

        $results = sqlsrv_query($_conn, $query_string);
        return sqlsrv_fetch_array($query_string, SQLSRV_FETCH_ASSOC);

        sqlsrv_close($_conn);
    }
	
?>