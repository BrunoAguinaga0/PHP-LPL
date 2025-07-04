<?php
require_once('servicios.class.php');
$servicios = Servicios::buscarServicios($_GET["empresa"], $_GET["dia"]);
if (is_null($servicios)) {
    $servicios = [];
}
echo json_encode($servicios);

?>