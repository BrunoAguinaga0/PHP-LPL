<?php
class Supermercado
{
    public function __construct() {}

    public static function getUbicacionesBD()
    {
        $conexion = new mysqli("localhost", "root", "", "comparador") or die("Error de conexion");
        $consulta = "SELECT DISTINCT ubicacion FROM supermercado";
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
