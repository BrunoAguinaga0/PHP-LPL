<?php
include_once("producto.class.php");
$idProducto = Producto::buscoIdProducto($_GET['busqueda']);
$precios = Producto::buscoPrecio($idProducto);
$supermercados = Producto::buscarIdSupermercado($idProducto);
$ubicaciones = array();
foreach($supermercados as $supermercado){
    $ubicaciones[] = Producto::buscoUbicacion($supermercado);
}
$criterio = $_GET['criterio'];
$filtro = $_GET['filtro'];
if ($criterio == 1){
    if ($filtro == 1){        
        $arregloPrecio = array();
        $arregloSupermercados = array();
        $arregloUbicaciones = array();
        foreach($precios as $precio){
            $arregloPrecio[] = $precio;
        }
        foreach($supermercados as $supermercado){
            $arregloSupermercados[] = $supermercado;
        }
        foreach ($ubicaciones as $ubicacion){
            $arregloUbicaciones[] = $ubicacion;
        }
        $arregloJSON[] = [
            'precios' => $arregloPrecio,
            'supermercados' => $arregloSupermercados,
            'ubicaciones' => $arregloUbicaciones
        ];
        $myJSON = json_encode($arregloJSON);
    }
    echo $myJSON;
}
?>