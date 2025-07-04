<?php
include_once("Supermercado.class.php");
$nombreSupermercado = $_GET["nombreSupermercado"];
$supermercados = Supermercado::getUbicacionesPorNombre($nombreSupermercado);
echo json_encode($supermercados);
?>