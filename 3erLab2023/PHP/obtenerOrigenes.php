<?php
require_once('servicios.class.php');
$ciudades = Servicios::obtenerCiudadesOrigen();
if (is_null($ciudades)) {
    echo json_encode([]);
} else {
    foreach ($ciudades as $ciudad) {
        $resultado[] = [
            'origen' => $ciudad->getOrigen()
        ];
    }
    echo json_encode($resultado);
}
?>