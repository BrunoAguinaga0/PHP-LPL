<?php
header("Content-Type: application/json");
require_once("persona.class.php");
$persona = Persona::muestroPersona($_POST["txtBuscar"]);
if (is_null($persona)) {
    $envioDatos = array("nombre" => "----", "apellido" => "----", "dni" => "No encontrado", "fechaNacimiento" => "----", "domicilio" => "----", "productos comprados" => "----");
    $myjson = json_encode($envioDatos);
} else {
    if (is_null($persona->getProductosComprados())) {
        $productos = "----";
    }else {
        $productos = $persona->getProductosComprados();
    }
    $envioDatos = array("nombre" => $persona->getNombre(), "apellido" => $persona->getApellido(), "dni" => $persona->getDNI(), "fechaNacimiento" => $persona->getFechaNacimiento(), "domicilio" => $persona->getDomicilio(), "productosComprados" => $productos);
    $myjson = json_encode($envioDatos);
}
echo $myjson;
