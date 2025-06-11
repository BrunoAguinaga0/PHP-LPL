<?php
class Paciente {
    private $nombre;
    private $peso;
    private $altura;
    private $imc;
    private $resultado;

    public function __construct($nombre, $peso, $altura, $imc, $resultado) {
        $this->nombre = htmlspecialchars($nombre);
        $this->peso = floatval($peso);
        $this->altura = floatval($altura);
        $this->imc = floatval($imc);
        $this->resultado = $resultado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getAltura() {
        return $this->altura;
    }

    public function getImc() {
        return $this->imc;
    }

    public function getResultado() {
        return $this->resultado;
    }
}
?>