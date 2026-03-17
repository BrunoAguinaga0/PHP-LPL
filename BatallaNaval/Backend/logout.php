<?php 
    session_start();
    require_once "../Classes/database/conexionBD.php";
    require_once "../Classes/database/JugadorDAO.php";
    $bd = new conexionBD();
    $jugadorDAO = new JugadorDAO($bd);
    if (isset($_SESSION["id_usuario"])){
        $jugadorDAO->guardarToken($id_usuario,NULL);
        session_unset();
        session_destroy();
        }
    if(isset($_COOKIE["recuerdame"])){
        setcookie("recuerdame","",time() - 3600, "/");
    }
        header("location: ../index.php");
    exit();
?>