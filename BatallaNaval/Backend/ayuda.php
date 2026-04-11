<?php
require_once "../Classes/entities/tablero.class.php";
session_start();
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../index.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['config_partida']['estado'] == 'jugando'){
    if($_SESSION['ayuda'] == false){
        $_SESSION['ayuda'] = true;
        $tableroIA = $_SESSION['tablero_ia'];
        $tableroJugador = $_SESSION['tablero_jugador'];
        $ayudaParaJugador = $tableroIA->darAyuda(); 
        $ayudaParaIA = $tableroJugador->darAyuda();
        if ($ayudaParaIA) {
            $_SESSION['ia_memoria']['trampa_f'] = $ayudaParaIA['fila'];
            $_SESSION['ia_memoria']['trampa_c'] = $ayudaParaIA['columna'];
        }
        header('Content-Type: application/json');
        echo json_encode($ayudaParaJugador);
        exit();
    }
}
?>