<?php
include_once("Producto.class.php");
$nombre = $_GET["nombre"];
$productos = Producto::getProductoPorNombre($nombre);
echo json_encode($productos);
?>