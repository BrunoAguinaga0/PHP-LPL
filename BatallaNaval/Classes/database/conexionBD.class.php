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

    public function desconectar(){
        $this->conexion->close();
    }

    public function getConexion(){
        return $this->conexion;
    }
}
?>