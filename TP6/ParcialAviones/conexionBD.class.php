<?php
class ConexionBD
{
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $baseDatos;
    private $conexion;

    public function __construct($baseActual)
    {
        $this->baseDatos = $baseActual;
    }
    // Conecta a la base de datos
    public function conectar()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->baseDatos);

        if ($this->conexion->connect_errno) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        return $this->conexion;
    }

    // Desconecta de la base de datos
    public function desconectar()
    {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}
?>