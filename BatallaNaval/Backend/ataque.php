<?php 
require_once "../Classes/entities/tablero.class.php";
require_once "../Classes/database/conexionBD.php";
require_once "../Classes/database/PartidaDAO.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['tablero_ia'])) {
    echo json_encode(["error" => "Acceso denegado"]);
    exit();
}
$fila = (int)$_POST['fila'];
$columna = (int)$_POST['columna'];
$tableroIA = $_SESSION['tablero_ia'];
$resultado =  $tableroIA->recibirDisparo($fila,$columna);
$respuesta = ["resultado" => $resultado,
                "victoria" => false];
if($resultado == "tocado"){
    if(!$tableroIA->quedanBarcos()){
        $respuesta["victoria"] = true;
        $_SESSION['config_partida']['estado'] = 'victoria';
        $bd = new ConexionBD();
        $partida = new PartidaDAO($bd);
        $segundosJugados = time() - $_SESSION['config_partida']['tiempo_inicio'];
        $fecha = date('Y-m-d H:i:s');
        $partida->guardarPartida($_SESSION["id_usuario"], $fecha, $segundosJugados, "victoria");
    }
}
$_SESSION['tablero_IA'] = $tableroIA;
header('Content-Type: application/json');
echo json_encode($respuesta);
exit();
?>