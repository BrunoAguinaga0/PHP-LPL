<?php
include_once("Producto.class.php");
$nombre = $_GET["nombreProducto"];
$productos = Producto::getDetallesProducto($nombre);
echo json_encode($productos);
?>