<?php
class Producto
{
    public function __destruct() {}

    public static function getProductoPorNombre($producto)
    {
        $conexion = new mysqli("localhost", "root", "", "comparador") or die("Error de conexion");
        $consulta = "SELECT
                    p.nombre AS nombre_producto,
                    pr.precio,
                    s.nombre AS nombre_supermercado,
                    s.ubicacion
                    FROM
                    producto p
                    JOIN precios pr ON p.id_producto = pr.id_producto
                    JOIN supermercado s ON s.id_supermercado = pr.id_supermercado
                    WHERE
                    p.nombre LIKE '$producto%'";
        $resultado = $conexion->query($consulta) or die("Error en la consutla");
        $lista = [];
        while ($registro = $resultado->fetch_object()) {
            $lista[] = $registro;
        }
        $resultado->free();
        $conexion->close();
        return $lista;
    }

    public static function getProductosPorUbicacion($ubicacion)
    {
        $conexion = new mysqli("localhost", "root", "", "comparador") or die("Error de conexion");
        $consulta = "SELECT
                    p.nombre AS nombre_producto,
                    pr.precio,
                    s.nombre AS nombre_supermercado,
                    s.ubicacion
                    FROM
                    producto p
                    JOIN precios pr ON p.id_producto = pr.id_producto
                    JOIN supermercado s ON s.id_supermercado = pr.id_supermercado
                    WHERE
                    s.ubicacion LIKE '$ubicacion'";
        $resultado = $conexion->query($consulta) or die("Error en la consutla");
        $lista = [];
        while ($registro = $resultado->fetch_object()) {
            $lista[] = $registro;
        }
        $resultado->free();
        $conexion->close();
        return $lista;
    }

    public static function getProductoPorAmbos($producto, $ubicacion)
    {
        $conexion = new mysqli("localhost", "root", "", "comparador") or die("Error de conexion");
        $consulta = "SELECT
                    p.nombre AS nombre_producto,
                    pr.precio,
                    s.nombre AS nombre_supermercado,
                    s.ubicacion
                    FROM
                    producto p
                    JOIN precios pr ON p.id_producto = pr.id_producto
                    JOIN supermercado s ON s.id_supermercado = pr.id_supermercado
                    WHERE
                    p.nombre LIKE '$producto%' AND s.ubicacion LIKE '$ubicacion'";
        $resultado = $conexion->query($consulta) or die("Error en la consutla");
        $lista = [];
        while ($registro = $resultado->fetch_object()) {
            $lista[] = $registro;
        }
        $resultado->free();
        $conexion->close();
        return $lista;
    }

    public static function getDetalleProducto($producto)
    {
        $conexion = new mysqli("localhost", "root", "", "comparador") or die("Error de conexion");
        $consulta = "SELECT
                    s.nombre AS nombre_supermercado,
                    pr.precio,
                    s.ubicacion
                    FROM
                    producto p
                    JOIN precios pr ON p.id_producto = pr.id_producto
                    JOIN supermercado s ON s.id_supermercado = pr.id_supermercado
                    WHERE
                    p.nombre LIKE '$producto%'";
        $resultado = $conexion->query($consulta) or die("Error en la consutla");
        $lista = [];
        while ($registro = $resultado->fetch_object()) {
            $lista[] = $registro;
        }
        $resultado->free();
        $conexion->close();
        return $lista;
    }

}
