<?php 
require_once '../Classes/database/conexionBD.php';
require_once '../Classes/database/jugadorDAO.php';
session_start();
if (!isset($_POST['usuario']) || !isset($_POST['contrasenia']) || !isset($_POST['confirmar_contrasenia'])) {
    header("Location: ../Pages/registro.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: ../Pages/registro.php");
    exit();
}

$bd = new conexionBD();
$jugadorDAO = new JugadorDAO($bd);
$nombre = $_POST['usuario'];
$pass1 = $_POST['contrasenia'];
$pass2 = $_POST['confirmar_contrasenia'];

if($pass1 !== $pass2){
    $_SESSION["error_contrasenia"] = "Marinero, las contraseñas no coinciden!";
    header("Location: ../Pages/registro.php");
    exit();
}
if ($jugadorDAO->existeUsuario($nombre)) {
    $_SESSION["error_usuario"] = "Ese usuario ya esta en batalla!";
    header("Location: ../Pages/registro.php");
    exit();
}
$resultado_registro = $jugadorDAO->registrarJugador($nombre, $pass1);
if ($resultado_registro) {
    $_SESSION["id_usuario"] = $jugadorDAO->autenticarJugador($nombre, $pass1)->id_jugador;
    header("Location: ../Pages/inicio.php");
    exit();
}else{
    $_SESSION["error_usuario"] = "Error al registrar el usuario!";
    header("Location: ../Pages/registro.php");
    exit();
}

?>