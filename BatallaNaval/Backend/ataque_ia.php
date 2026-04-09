<?php
require_once "../Classes/entities/tablero.class.php";
require_once "../Classes/database/conexionBD.class.php";
require_once "../Classes/entities/partida.class.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['tablero_jugador'])) {
    echo json_encode(["error" => "Acceso denegado"]);
    exit();
}
$tableroJugador = $_SESSION['tablero_jugador'];

$filas = (int)$_SESSION['config_partida']['filas'];
$columnas = (int)$_SESSION['config_partida']['columnas'];

$disparoValido = false;
$f = 0;
$c = 0;
$resultado = "";

while (!$disparoValido) {
    $f = rand(0, $filas - 1);
    $c = rand(0, $columnas - 1);
    $resultado = $tableroJugador->recibirDisparo($f, $c);
    if ($resultado !== "repetido" && $resultado !== "borde") {
        $disparoValido = true;
    }
}
$respuesta = [
    "fila" => $f,
    "columna" => $c,
    "resultado" => $resultado,
    "victoria_ia" => false
];
if ($resultado === "tocado") {
    if (!$tableroJugador->quedanBarcos()) {
        $respuesta["victoria_ia"] = true;
        $_SESSION['config_partida']['estado'] = 'derrota'; 
        $bd = new ConexionBD();
        $partida = new Partida($bd);
        $segundosJugados = time() - $_SESSION['config_partida']['tiempo_inicio'];
        $fecha = date('Y-m-d H:i:s');
        $partida->guardarPartida($_SESSION["id_usuario"], $fecha, $segundosJugados, "derrota");
    }
}
$_SESSION['tablero_jugador'] = $tableroJugador;
header('Content-Type: application/json');
echo json_encode($respuesta);
exit();
?>