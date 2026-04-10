<?php

class Tablero {
    private $matriz;
    private $filas;
    private $columnas;
    private $historialFlota;

    // El constructor puede recibir una matriz (Jugador) o crear una vacía (IA)
    public function __construct($filas, $columnas, $matrizInicial = null) {
        $this->filas = $filas;
        $this->columnas = $columnas;
        if ($matrizInicial) {
            $this->matriz = $matrizInicial;
        } else {
            $this->matriz = array_fill(0, $filas, array_fill(0, $columnas, 0));
        }
    }

    public function getMatriz() {
        return $this->matriz;
    }

    // Busca en la matriz una posibilidad de ubicar un barco
    public function buscarEspacioDisponible($largo, $orientacion) {
        $opcionesValidas = [];
        for ($f = 0; $f < $this->filas; $f++) {
            for ($c = 0; $c < $this->columnas; $c++) {
                if ($this->matriz[$f][$c] == 0) {
                    $lugar = true;
                    if ($orientacion == "horizontal") {
                        if (($c + $largo) <= $this->columnas) {
                            for ($i = 1; $i < $largo; $i++) {
                                if ($this->matriz[$f][$c + $i] !== 0) {
                                    $lugar = false;
                                    break;
                                }
                            }
                        } else { $lugar = false; }
                    } else {
                        if (($f + $largo) <= $this->filas) {
                            for ($i = 1; $i < $largo; $i++) {
                                if ($this->matriz[$f + $i][$c] !== 0) {
                                    $lugar = false;
                                    break;
                                }
                            }
                        } else { $lugar = false; }
                    }
                    if ($lugar) {
                        $opcionesValidas[] = ["fila" => $f, "columna" => $c];
                    }
                }
            }
        }
        if (count($opcionesValidas) > 0) {
            return $opcionesValidas[array_rand($opcionesValidas)];
        }
        return null;
    }

    //Registra la flota en la matriz
    public function registrarFlota($fila, $columna, $largo, $orientacion, $tipo) {
        for ($i = 0; $i < $largo; $i++) {
            if ($orientacion == "horizontal") {
                $this->matriz[$fila][$columna + $i] = 1;
            } else {
                $this->matriz[$fila + $i][$columna] = 1;
            }
        }
        $this->historialFlota[] = [
            "tipo" => $tipo,
            "fila" => $fila,
            "columna" => $columna,
            "largo" => $largo,
            "orientacion" => $orientacion,
            "hundido" => false
        ];
    }


    // Método para que el tablero de la IA se llene sola
public function inicializarAleatorio($cantidades) {
    $largos = [
        "portaviones" => 4,
        "acorazados"  => 3,
        "destructores" => 2,
        "submarinos"  => 1
    ];
    foreach ($cantidades as $tipo => $cantidad) {
        for ($i = 0; $i < $cantidad; $i++) {
            $largo = $largos[$tipo];
            $nroAzar = rand(0, 1);
            if ($nroAzar == 0) {
                $orientacion = "horizontal";
            } else {
                $orientacion = "vertical";
            }
            $pos = $this->buscarEspacioDisponible($largo, $orientacion);
            if ($pos == null) {
                if ($orientacion == "horizontal") {
                    $orientacion = "vertical";
                } else {
                    $orientacion = "horizontal";
                }
                $pos = $this->buscarEspacioDisponible($largo, $orientacion);
            }
            if ($pos !== null) {
                $this->registrarFlota($pos['fila'], $pos['columna'], $largo, $orientacion, $tipo);
            }
        }
    }
}

    public function recibirDisparo($f, $c) {
        $celda = $this->matriz[$f][$c];
        // Si es agua (0)
        if ($celda == 0) {
            $this->matriz[$f][$c] = 3; 
            return "agua";
        }
        // Si hay un barco (1)
        if ($celda == 1) {
            $this->matriz[$f][$c] = 2; 
            return "tocado";
        }
        // Si ya se disparo ahi antes (2 o 3)
        if ($celda == 2 || $celda == 3) {
            return "repetido";
        }
        // Si intento disparar a un borde (-1)
        return "borde";
    }

    public function quedanBarcos() {
        for ($f = 0; $f < $this->filas; $f++) {
            for ($c = 0; $c < $this->columnas; $c++) {
                if ($this->matriz[$f][$c] == 1) {
                    return true; // Encontró al menos un barco vivo
                }
            }
        }
        return false; // No hay más barcos (Game Over)
    }

    /* Devuelve un array solo con las coordenadas que fueron atacadas (2 y 3). */
    public function obtenerDisparos() {
        $disparos = [];
        for ($f = 0; $f < $this->filas; $f++) {
            for ($c = 0; $c < $this->columnas; $c++) {
                
                if ($this->matriz[$f][$c] == 2) {
                    $disparos[] = ['f' => $f, 'c' => $c, 'tipo' => 'tocado'];
                } 
                elseif ($this->matriz[$f][$c] == 3) {
                    $disparos[] = ['f' => $f, 'c' => $c, 'tipo' => 'agua'];
                }
                
            }
        }
        
        return $disparos;
    }

public function darAyuda(){
        $posiblesAyudas = [];
        for ($f = 0; $f < $this->filas; $f++) {
            for ($c = 0; $c < $this->columnas; $c++) {
                if ($this->matriz[$f][$c] == 1) {
                    $posiblesAyudas[] = ['fila' => $f, 'columna' => $c];
                }
            }
        }
        if (count($posiblesAyudas) > 0) {
            $indiceAleatorio = array_rand($posiblesAyudas);
            return $posiblesAyudas[$indiceAleatorio];
        }
        return false; 
    }
}
?>