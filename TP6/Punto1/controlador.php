<?php
include_once("pais.class.php");
$ciudades = Pais::getCiudadesBD($_GET['idPais']);
$objTemp = new StdClass();
if (is_null($ciudades)) {
    $objTemp->ciudades = 'Pais no encontrado';
    $myJSON = json_encode($objTemp);
} else {
    $objTemp->ciudades = $ciudades;
    $myJSON = json_encode($objTemp);
}
echo $myJSON;
