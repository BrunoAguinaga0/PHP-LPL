<?php
class Producto
{
    private $id_producto;
    private $id_supermercado;
    private $nombre;
    private $precio;

    public function __construct()
    {
        
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getIdSupermercado()
    {
        return $this->id_supermercado;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

        public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }
    
    public function setIdSupermercado($id_supermercado)
    {
        $this->id_supermercado = $id_supermercado;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public static function getProductoBD()
    {
        $conexion = new mysqli("localhost","root","","comparador") or die ("Error de conexion");
        $consulta = "SELECT nombre FROM producto";
        $resultado = $conexion->query($consulta) or die ("Error en la consulta");
        $productos = [];
        while ($registro = $resultado->fetch_object())
        {
            $unProd = new Producto();
            $unProd->setNombre($registro->nombre);
            $productos[] = $unProd;
        }
        $resultado->free();
        $conexion->close();
        return $productos;
    }

    public static function getProductoPorNombre($nombre)
    {
        $conexion = new mysqli("localhost","root","","comparador") or die ("Error de conexion");
        $consulta = "SELECT p.nombre as nombreProducto, pr.precio, s.nombre AS nombreSupermercado, s.ubicacion FROM producto AS p INNER JOIN precios as pr ON p.id_producto = pr.id_producto INNER JOIN supermercado AS s ON pr.id_supermercado = s.id_supermercado WHERE p.nombre LIKE '$nombre'";
        $resultado = $conexion->query($consulta) or die ("Error en la consulta");
        $productos = [];
        while ($registro = $resultado->fetch_object())
        {
            $productos[] = $registro;
        }
        $resultado->free();
        $conexion->close();
        return $productos;
    }


    public static function getProductoFiltrado ($nombre, $ubicacion)
    {
        $conexion = new mysqli("localhost","root","","comparador") or die ("Error de conexion");
        $consulta = "SELECT producto.nombre AS nombreProducto, precios.precio, supermercado.nombre AS nombreSupermercado, supermercado.ubicacion FROM producto INNER JOIN precios ON producto.id_producto = precios.id_producto INNER JOIN supermercado ON precios.id_supermercado = supermercado.id_supermercado WHERE supermercado.ubicacion LIKE '$ubicacion' AND producto.nombre LIKE '$nombre'";
        $resultado = $conexion->query($consulta) or die ("Error en la consulta");
        $productos = [];
        while ($registro = $resultado->fetch_object())
        {
            $productos[] = $registro;
        }
        $resultado->free();
        $conexion->close();
        return $productos;
    }

    public static function getDetallesProducto ($nombre)
    {
        $conexion = new mysqli("localhost","root","","comparador") or die ("Error de conexion");
        $consulta = "SELECT supermercado.nombre AS nombreSupermercado, precios.precio, supermercado.ubicacion FROM producto INNER JOIN precios ON producto.id_producto = precios.id_producto INNER JOIN supermercado ON precios.id_supermercado = supermercado.id_supermercado WHERE producto.nombre LIKE '$nombre' ORDER BY precios.precio DESC";
        $resultado = $conexion->query($consulta) or die ("Error en la consulta");
        $productos = [];
        while ($registro = $resultado->fetch_object())
        {
            $productos[] = $registro;
        }
        $resultado->free();
        $conexion->close();
        return $productos;
    }

}
?>