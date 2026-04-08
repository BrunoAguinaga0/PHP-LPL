<?php 
require_once "../Classes/entities/tablero.class.php";
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
    }
}
$_SESSION['tablero_IA'] = $tableroIA;
header('Content-Type: application/json');
echo json_encode($respuesta);
exit();
?>