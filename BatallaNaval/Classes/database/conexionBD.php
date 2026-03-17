<?php

class conexionBD{
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $conexion;
    private $baseDatos = "batallaNaval";

    public function __construct(){
        $this->conectar();
    }
    public function __destruct(){
        $this->desconectar();
    }

    public function conectar(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->baseDatos);
        if ($this->conexion->connect_errno) {
            die("Error de conexion: " . $this->conexion->connect_error);
        }
    }

    public function bd_consulta($sql,$tipos="",$parametros=[]){
        $stmt = $this->conexion->prepare($sql);
        if(!empty($parametros)){
            $stmt->bind_param($tipos,...$parametros);
        }
        $stmt->execute();
        $lista = $stmt->get_result();
        if ($lista){
            return $lista->fetch_all(MYSQLI_ASSOC);
        }
        else{
            return [];
        }
    }

    public function bd_ejecutar($sql,$tipos="",$parametros=[]){
        $stmt = $this->conexion->prepare($sql);
        if(!empty($parametros)){
            $stmt->bind_param($tipos,...$parametros);
        }
        return $resultado = $stmt->execute();
    }

    public function desconectar(){
        $this->conexion->close();
    }

    public function insert_id(){
        return $this->conexion->insert_id;
    }

    public function comenzar_transaccion(){
        $this->conexion->begin_transaction();
    }

    public function confirmar_transaccion(){
        $this->conexion->commit();
    }

    public function cancelar_transaccion(){
        $this->conexion->rollback();
    }
}
?>