<?php
class Pais
{
    private $id;
    private $nombre;
    private $ciudades = [];

    public function __construct($id, $nombre, $listaCiudades)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ciudades = $listaCiudades;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($Nombre)
    {
        $this->nombre = $Nombre;
    }

    public function getCiudades()
    {
        return $this->ciudades;
    }
    public function setCiudades($ciudades)
    {
        $this->ciudades = $ciudades;
    }

    public static function getCiudadesBD($pais)
    {
        $conexion = new mysqli("localhost", "root", "", "paisesbd") or die("No es posible conectarse al motor de BD");
        $query = "SELECT * FROM ciudades WHERE idPais = $pais ORDER BY nombreCiudad";
        $listado = $conexion->query($query) or die("No se pudo realizar la consulta");

        $resultado = [];
        while ($registro = $listado->fetch_object()) {
            $resultado[] = $registro->nombreCiudad;
        }
        $listado->free();
        $conexion->close();
        return $resultado;
    }
}
