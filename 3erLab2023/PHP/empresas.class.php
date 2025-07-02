<?php
require_once("conexionBD.class.php");
class Empresa {
    private $nombre;
    private $paisEmpresa;
    private $web;
    private $logo;
    private $numServicios;

    public function __construct($nombre, $paisEmpresa, $web, $logo, $numServicios) {
        $this->nombre = $nombre;
        $this->paisEmpresa = $paisEmpresa;
        $this->web = $web;
        $this->logo = $logo;
        $this->numServicios = $numServicios;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPaisEmpresa() {
        return $this->paisEmpresa;
    }

    public function getWeb() {
        return $this->web;
    }

    public function getLogo() {
        return $this->logo;
    }

    public static function buscarEmpresas($origen, $destino){
        $bd = new ConexionBD("raileurope");
        $bd->conectar();
        $conexion = $bd->getConexion();
        $query = self::tipoQuery($origen, $destino);
        $resultado = $conexion->query($query) or die("Error en la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0){
            while ($empresaBD = $resultado->fetch_object()){
                $empresas[] = $empresaBD;
            }
        }else{
            $empresas = null;
        }
        return $empresas;
    }

    private static function tipoQuery($origen, $destino) {
        if ($origen != "true" && $destino != "true") {
            $query = "SELECT e.nombreEmpresa as NOMBRE, e.paisEmpresa as PAIS, e.webEmpresa as WEB, e.logoEmpresa as LOGO, COUNT(s.idServicio) AS SERVICIOS 
                        FROM empresas e
                        JOIN servicios s ON e.idEmpresa = s.idEmpresa
                        WHERE s.ciudadOrigenServicio = '$origen' AND s.ciudadDestinoServicio = '$destino'
                        GROUP BY e.idEmpresa";
        }else if($origen != "true"){
            $query = "SELECT e.nombreEmpresa as NOMBRE, e.paisEmpresa as PAIS, e.webEmpresa as WEB, e.logoEmpresa as LOGO, COUNT(s.idServicio) AS SERVICIOS 
                        FROM empresas e
                        JOIN servicios s ON e.idEmpresa = s.idEmpresa
                        WHERE s.ciudadOrigenServicio = '$origen'
                        GROUP BY e.idEmpresa";
        }else{
            $query = "SELECT e.nombreEmpresa as NOMBRE, e.paisEmpresa as PAIS, e.webEmpresa as WEB, e.logoEmpresa as LOGO, COUNT(s.idServicio) AS SERVICIOS 
                        FROM empresas e
                        JOIN servicios s ON e.idEmpresa = s.idEmpresa
                        WHERE s.ciudadDestinoServicio = '$destino'
                        GROUP BY e.idEmpresa";
        }
        return $query;
    }
}

?>