<?php
require_once('conexionBD.class.php');
class Producto{
    private $producto;
    private $precio;
    private $ubicacion;
    private $supermercado;
    private $idProducto;


    public function __construct($producto, $precio, $ubicacion, $supermercado)
    {
        $this->producto = $producto;
        $this->precio = $precio;
        $this->ubicacion = $ubicacion;
        $this->supermercado = $supermercado;
    }

    public static function buscoIdProducto($produ)
    {
        $bd = new ConexionBD("comparador");
        $conexion = $bd->getConexion();
        $query = "SELECT id_producto FROM producto WHERE nombre = '$produ'";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            $productoBD = $resultado->fetch_object();
            $id = $productoBD->idProducto;
            return $id;
        }
        $resultado->free();
        $bd->desconectar();
    }

    public static function buscoPrecio($produ)
    {
        $bd = new ConexionBD("comparador");
        $conexion = $bd->getConexion();
        $query = "SELECT precio FROM precios WHERE id_producto = '$produ'";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            $precios = array();
            while ($productoBD = $resultado->fetch_object()){
                $precios[] = $productoBD->precio;
            }
        }else{
            $precios = null;
        }
        return $precios;
        $resultado->free();
        $bd->desconectar();
    }

    public static function buscarIdSupermercado($produ){
        $bd = new ConexionBD("comparador");
        $conexion = $bd->getConexion();
        $query = "SELECT id_supermercado FROM precios WHERE id_producto = '$produ'";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            $supermercados = array();
            while ($productoBD = $resultado->fetch_object()){
                $supermercados[] = $productoBD->id_supermercado;
            }
        }else{
            $supermercados = null;
        }
        return $supermercados;
        $resultado->free();
        $bd->desconectar();
    }

    public static function buscoUbicacion($idSuper){
        $bd = new ConexionBD("comparador");
        $conexion = $bd->getConexion();
        $query = "SELECT ubicacion FROM supermercado WHERE id_supermerado = '$idSuper'";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            $productoBD = $resultado->fetch_object();
            $ubicacion = $productoBD->ubicacion;
        }else{
            $ubicacion = null;
        }
        return $ubicacion;
        $resultado->free();
        $bd->desconectar();
    }
}
?>
