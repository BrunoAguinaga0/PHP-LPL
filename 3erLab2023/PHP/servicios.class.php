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

}