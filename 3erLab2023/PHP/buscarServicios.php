<?php
require_once("servicios.class.php");
$empresa = $_GET['empresa'];
$origen = $_GET['origen'];
$destino = $_GET['destino'];
$servicios = Servicios::buscarServicios($empresa, $origen, $destino);
if (!is_null($servicios)) {    
    foreach($servicios as $servicio) {
        $arrayServicios[] = $servicio;
    }
}else{
    $arrayServicios = [];
}
echo json_encode($arrayServicios);

?>