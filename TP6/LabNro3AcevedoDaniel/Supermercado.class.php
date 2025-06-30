<?php
class Supermercado
{
    private $id_supermercado;
    private $nombre;
    private $ubicacion;

    public function __construct()
    {
        
    }

    public function getId() {
        return $this->id_supermercado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getUbicacion() {
        return $this->ubicacion;
    }
    
    public function setId($id_supermercado) {
        $this->id_supermercado = $id_supermercado;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    public static function getSupermercadosBD ()
    {
        $conexion = new mysqli("localhost","root","","comparador") or die ("Error de conexion");
        $consulta = "SELECT * FROM supermercado ORDER BY id_supermercado";
        $resultado = $conexion->query($consulta) or die ("Error en la consulta");
        $supermercados = [];
        while ($registro = $resultado->fetch_object())
        {
            $super = new Supermercado();
            $super->setId($registro->id_supermercado);
            $super->setNombre($registro->nombre);
            $super->setUbicacion($registro->ubicacion);
            $supermercados[] = $super;
        }
        $resultado->free();
        $conexion->close();
        return $supermercados;
    }
    
    public static function getUbicacionesPorNombre($nombreSupermercado)
    {
        $conexion = new mysqli("localhost","root","","comparador") or die ("Error de conexion");
        $consulta = "SELECT producto.nombre AS nombreProducto, precios.precio, supermercado.nombre AS nombreSupermercado, supermercado.ubicacion FROM producto INNER JOIN precios ON producto.id_producto = precios.id_producto INNER JOIN supermercado ON precios.id_supermercado = supermercado.id_supermercado WHERE supermercado.ubicacion LIKE '$nombreSupermercado'";
        $resultado = $conexion->query($consulta) or die ("Error en la consulta");
        $supermercados = [];
        while ($registro = $resultado->fetch_object())
        {
            $supermercados[] = $registro;
        }
        $resultado->free();
        $conexion->close();
        return $supermercados;
    }
}
?>