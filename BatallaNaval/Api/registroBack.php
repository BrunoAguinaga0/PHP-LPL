<?php 
session_start();
require_once 'conexionBD.php';
require_once 'jugadorDAO.php';
$bd = new conexionBD();
$jugadorDAO = new JugadorDAO($bd);
$nombre = $_POST['usuario'];
$pass1 = $_POST['contrasenia'];
$pass2 = $_POST['confirmar_contrasenia'];
if($pass1 !== $pass2){
    $_SESSION["error_contrasenia"] = "Las contraseñas no coinciden marinero!";
    header("Location: ../Pages/registro.php");
    exit();
}
if ($jugadorDAO->existeUsuario($nombre)) {
    $_SESSION["error_usuario"] = "Este usuario ya esta en batalla!";
    header("Location: ../Pages/registro.php");
    exit();
}
if ($jugadorDAO->registrarJugador($nombre, $pass1)) {
    $_SESSION["id_usuario"] = $jugadorDAO->autenticarJugador($nombre, $pass1)->id_jugador;
    header("Location: ../Pages/inicio.php");
    exit();
}
?>