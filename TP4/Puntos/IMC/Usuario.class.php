<?php
class Usuario {
    private $nombre_usuario;
    private $passwd;
    private $visitas = 1;

    function __construct($nombre_usuario, $passwd)
    {
        $this->nombre_usuario = $nombre_usuario;
        $this->passwd = $passwd;
        $this->visitas = 1; // Inicializar visitas a 1
    }

    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    public function getVisitas()
    {
        return $this->visitas;
    }

    public function setVisitas($visitas)
    {
        $this->visitas = $visitas;
    }
}
?>