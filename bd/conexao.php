<?php
	require_once  $_SERVER['DOCUMENT_ROOT'] . "/function/function_php.php";

	$conn = new PDO("mysql:dbname=mrcake; host=localhost", "root", "");

	function getConnection(){
	    return new PDO("mysql:dbname=mrcake; host=localhost", "root", "");
    }

    class sql
    {

        public $senha;
        public $cpf;
        public $nome;
        public $nascimento;
        public $tel;
        public $cel;
        public $id_origem;

        public function __construct()
        {
            $this->conn = new PDO("mysql:dbname=mrcake; host=localhost", "root", "");
        }

        public function adm()
        {
            $sql = "SELECT * FROM administradores";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            if( $stmt === false)
            {
                die( print_r( $this->conn->errorInfo(), true) );
            }

            while( $row = $stmt->fetchAll(PDO::FETCH_ASSOC) )
            {
                echo $row['codigo'].", ".$row['nome']."<br />";
            }

        }

        public function verifica($email)
        {
            $sql = "SELECT count(*) total FROM usuarios where email = '$email'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if( $stmt === false)
            {
                die( print_r( $this->conn->errorInfo(), true) );
                header("location:logout.php");
            }

            $row = Indice_1($stmt, 'total');

            if($row!= 1)
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

            $sql = "SELECT id_origem, senha FROM usuarios where email = '$email'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if( $stmt === false)
            {
                die( print_r( $this->conn->errorInfo(), true) );
                header("location:logout.php");
            }
            //echo "<script>alert('$email');</script>";
            foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            {
                $senha = $row['senha'];
                $id_origem = $row['id_origem'];
            }

            $sql = "SELECT cpf, nome, telefone, celular FROM clientes where id_cliente = '$id_origem'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if( $stmt === false)
            {
                die( print_r( $this->conn->errorInfo(), true) );
                header("location:logout.php");
            }

            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row )
            {
                $cpf = $row['cpf'];
                $nome = $row['nome'];
                //$nascimento = $row['nascimento'];
                //$nascimento = "1987-04-10";
                $tel = $row['telefone'];
                $cel = $row['celular'];
            }

        }
        private function get_historico_compras($id_cliente, $status){

            $sql = "SELECT codigo, num_pedido, id_cliente, id_produto, `status`, cod_endereco_entrega FROM Pedidos WHERE id_cliente = $id_cliente AND status = $status"; // aqui status = 1 significa recebido
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if($stmt === false){
                die(print_r($this->conn->errorInfo(), true));
                header("location:logout.php");
            }
            $results = array();

            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
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
	/*
    $email = 'Fernadolo11ok1@outlook.com1';
    $senha = '11';
    $stmt = $conn->prepare("SELECT senha FROM Clientes where senha = '$senha' AND where email = $email");
    $stmt-> execute();
    var_dump($stmt);
    $indice = 'senha';
    $result_senha =  Indice_1($stmt, $indice);//retorna a senha
    echo "$result_senha";
    var_dump($result_senha);
	*/
?>