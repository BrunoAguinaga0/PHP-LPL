<?php
require_once('conexionBD.class.php');

class Servicios{

    private $idServicio;
    private $ciudadOrigen;
    private $ciudadDestino;
    private $horaSalida;
    private $horaLlegada;

    public static function buscarServicios($empresa,$dia){
        $bd = new ConexionBD("microslargadistancia");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = self::tipoQuery($empresa, $dia);
        $resultado = $conexion->query($query);
        if ($resultado->num_rows > 0) {
            while ($servicioBD = $resultado->fetch_object())
                $servicios[] = $servicioBD;
        }else {
            $servicios = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $servicios;
    }

    public static function buscarServiciosEmpresa($idServicio){
        $bd = new ConexionBD("microslargadistancia");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT operaLU as lu, operaMA as ma , operaMI as mi, operaJU as ju, operaVI as vi, operaSA as sa, operaDO as do, asientosSemicama as semi, precioPasajeSemicama as precioSemi, asientosCama as cama, precioPasajeCama as precioCama, e.webEmpresa as web
                    FROM servicios
                    JOIN empresas as e ON e.idEmpresa = servicios.idEmpresa
                    WHERE idServicio = '$idServicio'";
        $resultado = $conexion->query($query);
        if ($resultado->num_rows > 0) {
            while ($servicioBD = $resultado->fetch_object())
                $servicios[] = $servicioBD;
        }else {
            $servicios = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $servicios;
    }

    private static function tipoQuery($empresa, $dia){
        if ($empresa != "true" && $dia != "true") {
            $query = "SELECT s.idServicio as servicio, s.ciudadOrigen as origen, s.ciudadDestino as destino, s.horaSalida as salida, s.horaLlegada as llegada 
                        FROM servicios as s
                        JOIN empresas as e ON e.idEmpresa = s.idEmpresa
                        WHERE e.nombreEmpresa = '$empresa' and s." .$dia. "= true";
        }else if($empresa != "true"){
            $query = "SELECT s.idServicio as servicio, s.ciudadOrigen as origen, s.ciudadDestino as destino, s.horaSalida as salida, s.horaLlegada as llegada 
                        FROM servicios as s
                        JOIN empresas as e ON e.idEmpresa = s.idEmpresa
                        WHERE e.nombreEmpresa = '$empresa'";
        }else {
            $query = "SELECT s.idServicio as servicio, s.ciudadOrigen as origen, s.ciudadDestino as destino, s.horaSalida as salida, s.horaLlegada as llegada 
                        FROM servicios as s
                        JOIN empresas as e ON e.idEmpresa = s.idEmpresa
                        WHERE " .$dia. "= true";
        }
    return $query;
    }

}