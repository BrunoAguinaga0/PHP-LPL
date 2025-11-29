<?php
require_once('conexionBD.class.php');
class Servicios {
    private $origen;
    private $destino;

    public function getOrigen() {
        return $this->origen;
    }

    public function getDestino() {
        return $this->destino;
    }

    public function setOrigen($origen) {
        $this->origen = $origen;
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }


    public static function obtenerCiudadesOrigen() {
        $bd = new ConexionBD("raileurope");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT DISTINCT ciudadOrigenServicio FROM servicios";
        $resultado = $conexion->query($query);
        if ($resultado->num_rows > 0) {
            while ($ciudadBD = $resultado->fetch_object()) {
                $ciudad = new Servicios();
                $ciudad->setOrigen($ciudadBD->ciudadOrigenServicio);
                $ciudades[] = $ciudad;
            }
        }else{
            $ciudades = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $ciudades;
    }

    public static function obtenerCiudadesDestino(){
        $bd = new ConexionBD("raileurope");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT DISTINCT ciudadDestinoServicio FROM servicios";
        $resultado = $conexion->query($query);
        if ($resultado->num_rows > 0) {
            while ($ciudadBD = $resultado->fetch_object()) {
                $ciudad = new Servicios();
                $ciudad->setDestino($ciudadBD->ciudadDestinoServicio);
                $ciudades[] = $ciudad;
            }
        }else{
            $ciudades = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $ciudades;
    }

    public static function buscarServicios($nombre, $origen, $destino){
        $bd = new ConexionBD("raileurope");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = self::tipoQuery($nombre, $origen, $destino);
        $resultado = $conexion->query($query);
        if ($resultado->num_rows > 0) {
            while ($servicioBD = $resultado->fetch_object()) {
                $servicios[] = $servicioBD;
            }
        }else{
            $servicios = null;
        }
        $resultado->free();
        $bd->desconectar();
        return $servicios;
    }
    private static function tipoQuery($nombre, $origen, $destino) {
        if ($origen != "true" && $destino != "true") {
            $query = "SELECT nroServicio AS SERVICIO, estacionOrigenServicio as ORIGEN, estacionDestinoServicio as DESTINO, horaSalidaServicio as SALIDA, horaLlegadaServicio as LLEGADA, frecuenciaServicio as FRECUENCIA, precioServicio as PRECIO 
                    FROM `servicios`
                    JOIN empresas as e on e.idEmpresa = servicios.idEmpresa
                    WHERE e.nombreEmpresa = '$nombre' and servicios.ciudadOrigenServicio = '$origen' AND servicios.ciudadDestinoServicio = '$destino'";
        } else if ($origen != "true") {
            $query = "SELECT nroServicio AS SERVICIO, estacionOrigenServicio as ORIGEN, estacionDestinoServicio as DESTINO, horaSalidaServicio as SALIDA, horaLlegadaServicio as LLEGADA, frecuenciaServicio as FRECUENCIA, precioServicio as PRECIO 
                    FROM `servicios`
                    JOIN empresas as e on e.idEmpresa = servicios.idEmpresa
                    WHERE e.nombreEmpresa = '$nombre' and servicios.ciudadOrigenServicio = '$origen'";
        } else {
            $query = "SELECT nroServicio AS SERVICIO, estacionOrigenServicio as ORIGEN, estacionDestinoServicio as DESTINO, horaSalidaServicio as SALIDA, horaLlegadaServicio as LLEGADA, frecuenciaServicio as FRECUENCIA, precioServicio as PRECIO
                    FROM `servicios`
                    JOIN empresas as e on e.idEmpresa = servicios.idEmpresa
                    WHERE e.nombreEmpresa = '$nombre' and servicios.ciudadDestinoServicio = '$destino'";
        }
        return $query;
    }
}