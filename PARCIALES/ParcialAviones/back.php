<?php
    header('Content-Type: application/json');
    require_once("aviones.class.php");
    $lista = avion::buscarAvion($_GET["aeroNave"]);
    if(is_null($lista)){
        $myJSON = json_encode([]);
    }else{
        $arrayParaJson = [];
        foreach ($lista as $avion) {
        $arrayParaJson[] = [
            'matricula' => $avion->getMatricula(),
            'fechaIngreso' => $avion->getFechaIngreso(),
            'capacidad' => $avion->getCapacidad(),
            'distribucion' => $avion->getDistribucion(),
            'modelo' => $avion->getNombreModelo(),
            'fabricante' => $avion->getFabricante()
        ];
        }
        $myJSON = json_encode($arrayParaJson);
    }
    echo $myJSON;
?>