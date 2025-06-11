<?php
class Paciente {
    private $nombre;
    private $peso;
    private $altura;
    private $IMC;

    public function __construct($nombre, $peso, $altura) {
        $this->nombre = $nombre;
        $this->peso = $peso;
        $this->altura = $altura;
        $this->IMC = $this->peso / (($this->altura / 100) * ($this->altura / 100));
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
    public function getIMC() {
        return $this->IMC;
    }
    
    public function getResultado() {
        if ($this->IMC < 18.5) {
            return "Bajo Peso";
        } elseif ($this->IMC >= 18.5 && $this->IMC < 24.9) {
            return "Peso Normal";
        } elseif ($this->IMC >= 25 && $this->IMC < 29.9) {
            return "Sobrepeso";
        } else {
            return "Obesidad";
        }
    }
    }
?>