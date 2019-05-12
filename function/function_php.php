<?php 
    $conn = new PDO("mysql:dbname=mrcake; host=localhost", "root", "");
    function Indice_1($stmt, $indice){
        $resultado = $stmt-> fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $key => $value) {
        return $result = $value[$indice];//retorna 1 indice
        }
    }
 ?>