<?php
require_once('servicios.class.php');
$servicios = Servicios::buscarServiciosEmpresa($_GET["servicio"]);
if (is_null($servicios)) {
    $servicios = [];
}
echo json_encode($servicios);
?>