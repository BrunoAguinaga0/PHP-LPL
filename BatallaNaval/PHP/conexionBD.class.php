<?php
class conexionBD{
    public $baseDatos = "batallaNaval";
    public $host = "localhost";
    public $usuario = "root";
    public $password = "";
    public $conexion = null;

    public function conectar(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->baseDatos);
        if ($this->conexion->connect_errno) {
            die("Error de conexion: " . $this->conexion->connect_error);
        }
        return $this->conexion;
    }

    public function desconectar(){
        $this->conexion->close();
    }
}
?>