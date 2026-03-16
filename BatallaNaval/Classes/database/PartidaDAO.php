<?php 
class PartidaDAO{
    private $bd;
    public function __construct($baseDatos){
        $this->bd = $baseDatos->getConexion();
    }
}
?>