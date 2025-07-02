<?php
require_once("empresas.class.php");
$origen = $_GET['origen'];
$destino = $_GET['destino'];
$empresas = Empresa::buscarEmpresas($origen, $destino);

if (is_null($empresas)) {    
    foreach($empresas as $empresa) {
        $arrayEmpresas[] = $empresa;
    }
}else{
    $arrayEmpresas = [];
}
echo json_encode($empresas);
?>