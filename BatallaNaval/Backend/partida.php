<?php
require_once "../Classes/entities/tablero.class.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['ia_memoria']);
    $tamanio = (int)$_POST['tamanio-tablero'];
    $filas = (int)$_POST['filas_tablero'];
    $columnas = (int)$_POST['columnas_tablero'];
    $matrizJugador = json_decode($_POST['matriz_jugador'], true);
    $cantidadesFlota = json_decode($_POST['cantidades_flota'], true);
    $historialFlota = json_decode($_POST['historial_jugador'], true);
    $objTableroJugador = new Tablero($filas, $columnas, $matrizJugador);
    $objTableroIA = new Tablero($filas, $columnas);
    $objTableroIA->inicializarAleatorio($cantidadesFlota);
    $_SESSION['tablero_jugador'] = $objTableroJugador;
    $_SESSION['tablero_ia'] = $objTableroIA;
    $_SESSION['config_partida'] = [
        "tamanio" => $tamanio,
        "filas" => $filas,
        "columnas" => $columnas,
        "cantidades" => $cantidadesFlota,
        "historial_jugador" => $historialFlota,
        "estado" => 'jugando'
    ];
    header("Location: ../Pages/juego_batalla.php");
    exit();
} else {
    // Si alguien intenta entrar a este archivo directamente por URL, lo mandamos al inicio
    header("Location: ../Pages/inicio.php");
    exit();
}
?>