<?php
require_once("servicios.class.php");
$ciudades = Servicios::obtenerCiudadesDestino();
if (is_null($ciudades)) {
    echo json_encode([]);
} else {
    foreach ($ciudades as $ciudad) {
        $resultado[] = [
            'destino' => $ciudad->getDestino()
        ];
    }
}
echo json_encode($resultado);
?>