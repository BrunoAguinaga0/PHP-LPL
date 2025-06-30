<?php
require_once("conexionBD.class.php");
class Persona
{
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $dni;
    private $domicilio;
    private $productosComprados;

    public function __construct($nombrePersona, $apellidoPersona, $fechaNacimientoPer, $dniPer, $docimicilioPer, $productos)
    {
        $this->nombre = $nombrePersona;
        $this->apellido = $apellidoPersona;
        $this->fechaNacimiento = $fechaNacimientoPer;
        $this->dni = $dniPer;
        $this->domicilio = $docimicilioPer;
        $this->productosComprados = $productos;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDNI() {
        return $this->dni;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function getProductosComprados() {
        return $this->productosComprados;
    }

    public static function muestroPersona($dni){
        $BaseDatos = new ConexionBD("personasbd");
        $BaseDatos->conectar();
        $conexion = $BaseDatos->getConexion();
        $query1 = "SELECT * FROM personas WHERE dni = '$dni'";
        $query2 = "SELECT p.nombreProducto FROM productos p JOIN compras c ON p.idProducto = c.idProducto WHERE c.dni = '$dni'";
        $resultado = $conexion->query($query1) or die("Error al realizar la consulta: " . $conexion->error);
        $resultado2 = $conexion->query($query2) or die("Error al realizar la consulta: " . $conexion->error);
        if ($resultado->num_rows > 0) {
            $personaBD = $resultado->fetch_object();
            $nombrePersona = $personaBD->nombre;
            $apellidoPersona = $personaBD->apellido;
            $fechaNacimientoPer = $personaBD->fechaNacimiento;
            $domicilioPer = $personaBD->domicilio;
            $dniPer = $personaBD->dni;
            if ($resultado2->num_rows > 0) {
                while ($producto = $resultado2->fetch_object()) {
                    $productos[] = $producto->nombreProducto;
                }
            }else {
                $productos = null;
            }
            $persona = new Persona($nombrePersona, $apellidoPersona, $fechaNacimientoPer, $dniPer, $domicilioPer,$productos);
        }else {
            $persona = null;
        }
        $BaseDatos->desconectar();
        return $persona;
    }

}
