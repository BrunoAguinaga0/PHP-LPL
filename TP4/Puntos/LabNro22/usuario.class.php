<?php
class Usuario {
    private $DNI;
    private $clave;

    public function __construct($DNI, $clave) {
        $this->DNI = $DNI;
        $this->clave = $clave;
    }

    public function getDNI() {
        return $this->DNI;
    }

    public function getClave() {
        return $this->clave;
    }
}   