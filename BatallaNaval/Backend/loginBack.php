<?php
session_start();
require_once "../Classes/database/conexionBD.php";
require_once "../Classes/database/jugadorDAO.php";
$bd = new conexionBD();
$jugadorDAO = new JugadorDAO($bd);
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];
$jugador = $jugadorDAO->autenticarJugador($usuario,$contrasenia);
if($jugador) {
    $_SESSION["id_usuario"] = $jugador["id_jugador"];
    $_SESSION["nombre_usuario"] = $jugador["nombre_usuario"];
    if (isset($_POST["remember"])){
        $token = bin2hex(random_bytes(32));
        $jugadorDAO->guardarToken($jugador["id_jugador"],$token);
        setcookie("recuerdame",$token, time() + (3600 * 24 * 30), "/");
    }
    header("Location: ../Pages/inicio.php");
    exit();
};
$_SESSION["error_ingreso"] = "El usuario o contraseña que ingresaste es incorrecto.";
    header("Location: ../index.php");
    exit();
?>
