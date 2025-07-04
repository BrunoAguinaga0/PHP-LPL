<?php
include_once("ConexionBD.class.php");
class avion{
    private $idAvion;
    private $idModelo;
    private $matricula;
    private $fechaIngreso;
    private $capacidad;
    private $distribucion;
    private $nombreModelo;
    private $fabricante;

    public function __construct($matriculaAvion,$fechaIngresoAvion,$capacidadAvion,$distribucionAvion,$nombre,$fabricanteAvion)
    {
        $this->matricula = $matriculaAvion;
        $this->fechaIngreso = $fechaIngresoAvion;
        $this->capacidad = $capacidadAvion;
        $this->distribucion = $distribucionAvion;
        $this->nombreModelo = $nombre;
        $this->fabricante = $fabricanteAvion;
    }

    public function getMatricula(){
        return $this->matricula;
    }

    public function getFechaIngreso(){
        return $this->fechaIngreso;
    }

    public function getCapacidad(){
        return $this->capacidad;
    }

    public function getDistribucion(){
        return $this->distribucion;
    }

    public function getNombreModelo(){
        return $this->nombreModelo;
    }

    public function getFabricante(){
        return $this->fabricante;
    }

    public static function buscarAvion($nomReducido){
        $bd = new ConexionBD("aerolineas");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = "SELECT a.matricula, a.fechaIngreso, a.capacidad, a.distribucion, m.nombre, m.fabricante FROM aviones a JOIN modelos m ON a.idModelo = m.idModelo WHERE m.nombreReducido = '$nomReducido'";
        $resultado = $conexion->query($query) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0 ){
            $lista = array();
            while($avionBD = $resultado->fetch_object()){
                $matricula = $avionBD->matricula;
                $fechaIngreso = $avionBD->fechaIngreso;
                $capacidad = $avionBD->capacidad;
                $distribucion = $avionBD->distribucion;
                $nombre = $avionBD->nombre;
                $fabricante = $avionBD->fabricante;
                $avion = new avion($matricula,$fechaIngreso,$capacidad,$distribucion,$nombre,$fabricante);
                $lista[] = $avion;
            }
        }else{
            $lista = null;
        }
        $bd->desconectar();
        return $lista;
    }
}

?>