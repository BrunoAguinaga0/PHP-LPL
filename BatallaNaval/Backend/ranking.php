<?php
require_once "../Classes/database/conexionBD.php";
require_once "../Classes/database/PartidaDAO.php";
session_start();
$bd = new conexionBD();
$partidaDAO = new PartidaDAO($bd);
$ranking = $partidaDAO->rankingTop5();
header('Content-Type: application/json');
unset($_SESSION['config_partida']);
echo json_encode($ranking);
exit();
?>