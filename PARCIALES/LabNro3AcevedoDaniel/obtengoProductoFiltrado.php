<?php
include_once("Producto.class.php");
$nombre = $_GET["nombreProducto"];
$ubicacion = $_GET["ubicacion"];
$productos = Producto::getProductoFiltrado($nombre, $ubicacion);
echo json_encode($productos);
?>