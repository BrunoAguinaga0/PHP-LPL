<?php 
require_once "../Classes/database/conexionBD.php";
require_once "../Classes/database/PartidaDAO.php";
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['config_partida'])){
    $bd = new ConexionBD();
    $partida = new PartidaDAO($bd);
    $segundosJugados = time() - $_SESSION['config_partida']['tiempo_inicio'];
    $fecha = date('Y-m-d H:i:s');
    $partida->guardarPartida($_SESSION["id_usuario"], $fecha, $segundosJugados, "abandonada");
    $_SESSION['config_partida']['estado'] = 'abandonada';
    header('Content-Type: application/json');
    echo json_encode([
        "estado" => "abandonada"
    ]);
    exit();
}


?>