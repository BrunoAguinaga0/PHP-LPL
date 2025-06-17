<?php
class juego {
    private $intentos;
    private $ganado;
    private $perdido;
    private $mensajeJuego;


    public function __construct() {
        $this->intentos = 10;
        $this->ganado = false;
        $this->mensajeJuego = "";
        $this->perdido = false;
    }
    public function getMensajeJuego() {
        return $this->mensajeJuego;
    }

    public function setMensajeJuego($mensajeJuego) {
        $this->mensajeJuego = $mensajeJuego;
    }

    public function getGanado() {
        return $this->ganado;
    }

    public function setGanado($ganado) {
        $this->ganado = $ganado;
    }
    public function getIntentos() {
        return $this->intentos;
    }

    public function restoIntentos() {
        $this->intentos--;
    }

    public function setPerdido($perdido) {
        $this->perdido = $perdido;
    }

    public function getPerdido() {
        return $this->perdido;
    }
    
    public function calculoCentroNumerico($numero) {
        $sumatoria = 0;
        $sumatoria2 = 0;
        for ($i = 1; $i < $numero; $i++) {
            $sumatoria = $sumatoria + $i;
        }
        for ($i = ($numero + 1); $sumatoria2 <= $sumatoria; $i++) {
            $sumatoria2 = $sumatoria2 + $i;
            if ($sumatoria2 == $sumatoria) {
                break;
            }
        }
        if ($sumatoria2 == $sumatoria) {
            return true;
        }else{
            return false;
        }
    }

    public function rangoNumeros($numero) {
        $rangoInicial = $numero - 5;
        $rangoFinal = $numero + 5;
        $cercano = false;
        for ($i = $rangoInicial; $i <= $rangoFinal; $i++) {
            if ($i > 0) {
                $cercano = $this->calculoCentroNumerico($i);
            }
            if ($cercano) {
                break;
            }
        }
        return $cercano;
    }
}

?>