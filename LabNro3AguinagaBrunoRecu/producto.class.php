<?php
require_once('conexionBD.class.php');
class Producto{
    private $producto;
    private $precio;
    private $ubicacion;
    private $supermercado;


    public function __construct($producto, $precio, $ubicacion, $supermercado)
    {
        $this->producto = $producto;
        $this->precio = $precio;
        $this->ubicacion = $ubicacion;
        $this->supermercado = $supermercado;
    }

    public function getProducto(){
        return $this->producto;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getUbicacion(){
        return $this->ubicacion;
    }
    public function getSupermercado(){
        return $this->supermercado;
    }

    public static function buscarProducto($produ){
        $bd = new ConexionBD("comparador");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT p.nombre as PRODUCTO, s.nombre as SUPERMERCADO, pr.precio as PRECIO, s.ubicacion as UBICACION 
        FROM precios as pr 
        JOIN producto as p ON p.id_producto = pr.id_producto
        JOIN supermercado as s ON s.id_supermercado = pr.id_supermercado
        WHERE p.nombre like '$produ'";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            while ($productoBD = $resultado->fetch_object()){
                $nombreProducto = $productoBD->PRODUCTO;
                $precioProducto = $productoBD->PRECIO;
                $nombreSuper = $productoBD->SUPERMERCADO;
                $ubicacionSuper = $productoBD->UBICACION;
                $producto = new Producto($nombreProducto, $precioProducto, $ubicacionSuper, $nombreSuper);
                $productos[] = $producto;
            }
        }else {
            $productos = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $productos;
    }

    public static function buscarUbicacion($ubicacion){
        $bd = new ConexionBD("comparador");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT p.nombre as PRODUCTO, s.nombre as SUPERMERCADO, pr.precio as PRECIO, s.ubicacion as UBICACION 
        FROM precios as pr 
        JOIN producto as p ON p.id_producto = pr.id_producto
        JOIN supermercado as s ON s.id_supermercado = pr.id_supermercado
        WHERE s.ubicacion like '$ubicacion'";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            while ($productoBD = $resultado->fetch_object()){                
                $nombreProducto = $productoBD->PRODUCTO;
                $precioProducto = $productoBD->PRECIO;
                $nombreSuper = $productoBD->SUPERMERCADO;
                $ubicacionSuper = $productoBD->UBICACION;
                $producto = new Producto($nombreProducto, $precioProducto, $ubicacionSuper, $nombreSuper);
                $productos[] = $producto;
            }
        }else {
            $productos = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $productos;
    }

    public static function getProductos(){
        $bd = new ConexionBD("comparador");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT nombre FROM producto";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            while ($productoBD = $resultado->fetch_object()){
                $nombreProducto = $productoBD->nombre;
                $productos[] = $nombreProducto;
            }
        }else {
            $productos = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $productos;
    }

    public static function buscoCombinado($produ, $ubicacion){
        $bd = new ConexionBD("comparador");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT p.nombre as PRODUCTO, s.nombre as SUPERMERCADO, pr.precio as PRECIO, s.ubicacion as UBICACION 
        FROM precios as pr 
        JOIN producto as p ON p.id_producto = pr.id_producto
        JOIN supermercado as s ON s.id_supermercado = pr.id_supermercado
        WHERE p.nombre like '$produ' and s.ubicacion like '$ubicacion'";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            $productos = array();
            while ($productoBD = $resultado->fetch_object()){
                $nombreProducto = $productoBD->PRODUCTO;
                $precioProducto = $productoBD->PRECIO;
                $nombreSuper = $productoBD->SUPERMERCADO;
                $ubicacionSuper = $productoBD->UBICACION;
                $producto = new Producto($nombreProducto, $precioProducto, $ubicacionSuper, $nombreSuper);
                $productos[] = $producto;
            }
        }else {
            $productos = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $productos;
    }
}
?>
