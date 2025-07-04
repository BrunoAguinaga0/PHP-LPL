<?php

class Juego {
    private $nroPartida;
    private $puntosJugador;
    private $puntosComputadora;
    private $turno;
    private $ganador;
    private $msjGanador;
    private $agregarTabla;
    private $tiradas;

    public function __construct($nroPartida) {
        $this->nroPartida = $nroPartida;
        $this->puntosJugador = 20;
        $this->puntosComputadora = 20;
        $this->turno = 1;
        $this->ganador = 0;
        $this->msjGanador = "";
        $this->agregarTabla = "";
        $this->tiradas = 1;
    }

    private function tirarDado() {
        
        srand((double)microtime() * 10000000);
        $dado = rand(1, 6);
        return $dado;
    }

    public function logicaJuego() {
        $dado = $this->tirarDado();
        if ($this->turno == 1) {
            switch ($dado) {
                case 1:
                    $this->puntosJugador += 6;
                    $this->puntosComputadora -= 6;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Bruno</td><td>1</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 2:
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Bruno</td><td>2</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 3:
                    $this->puntosJugador -= 2;
                    $this->puntosComputadora += 4;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Bruno</td><td>3</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 4:
                    $this->puntosJugador += 4;
                    $this->puntosComputadora -= 2;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Bruno</td><td>4</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 5:
                    $this->puntosJugador -= 3;
                    $this->puntosComputadora -= 3;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Bruno</td><td>5</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 6:
                    $this->puntosJugador += 1;
                    $this->puntosComputadora -= 3;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Bruno</td><td>6</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
            }
            $this->turno = 2;
        } else {
            switch ($dado) {
                case 1:
                    $this->puntosComputadora += 6;
                    $this->puntosJugador -= 6;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Maquina</td><td>1</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 2:
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Maquina</td><td>2</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 3:
                    $this->puntosComputadora -= 2;
                    $this->puntosJugador += 4;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Maquina</td><td>3</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 4:
                    $this->puntosComputadora += 4;
                    $this->puntosJugador -= 2;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Maquina</td><td>4</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 5:
                    $this->puntosComputadora -= 3;
                    $this->puntosJugador -= 3;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Maquina</td><td>5</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
                case 6:
                    $this->puntosComputadora += 1;
                    $this->puntosJugador -= 3;
                    $this->agregarTabla .= "<tr><td>$this->tiradas</td><td>Maquina</td><td>6</td><td>$this->puntosJugador</td><td>$this->puntosComputadora</td></tr>";
                    $this->tiradas += 1;
                    break;
            }
            $this->turno = 1;
        }
    }

    public function getNroPartida() {
        return $this->nroPartida;
    }

    public function getPuntosJugador() {
        return $this->puntosJugador;
    }

    public function getPuntosComputadora() {
        return $this->puntosComputadora;
    }

    public function getTirada() {
        return $this->tiradas;
    }

    public function getGanador(){
        return $this->ganador;
    }

    public function setGanador($gano){
        $this->ganador = $gano;
    }

    public function getMensajeGanador() {
        return $this->msjGanador;
    }

    public function setMensajeGanador($msj){
        $this->msjGanador = $msj;
    }

    public function getAgregarTabla(){
        return $this->agregarTabla;
    }

    public function getTurno(){
        return $this->turno;
    }
}