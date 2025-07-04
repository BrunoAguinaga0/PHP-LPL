<?php
require_once('conexionBD.class.php');

class Productos{

    private $nombre;
    private $idProducto;

    public function __construct($nombre, $idProducto){
        $this->nombre = $nombre;
        $this->idProducto = $idProducto;
    }

    public static function buscarProductos(){
        $bd = new ConexionBD("computacion");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT codigo as id, nombreProducto as nombre FROM producto";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            while ($productoBD = $resultado->fetch_object()){
                $productos[] = $productoBD;
            }
        }else {
            $productos = [];
        }
        $resultado->free();
        $bd->desconectar();
        return $productos;
    }

    public static function buscarDatosProductos($nombre){
        $bd = new ConexionBD("computacion");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT  p.provedor as provedor, SUM(s.cantidada) as stock , s.nombreSucursal as sucursal, s.cantidada as stockSucursal
                    FROM sucursal s
                    JOIN producto p ON p.idProducto = s.idProducto
                    WHERE p.nombreProducto = $nombre";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            while ($productoBD = $resultado->fetch_object()){
                $productos[] = $productoBD;
            }
        }else {
            $productos = [];
        }
        $resultado->free();
        $bd->desconectar();
        return $productos;
    }
}

?>