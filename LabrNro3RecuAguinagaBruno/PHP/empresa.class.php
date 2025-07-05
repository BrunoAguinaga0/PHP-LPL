<?php
require_once('conexionBD.class.php');

class Empresa {
    private $nombreEmpresa;


    public static function buscoEmpresas(){
        $bd = new ConexionBD("microslargadistancia");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT nombreEmpresa as Empresa FROM empresas";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            while ($empresaBD = $resultado->fetch_object())
                $empresas[] = $empresaBD;
        }else {
            $empresas = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $empresas;

    }
}