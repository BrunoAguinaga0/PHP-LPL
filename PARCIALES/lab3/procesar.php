<?php
include_once("Producto.class.php");
if (isset($_GET["producto"]) && isset($_GET["ubicacion"]) && $_GET["ubicacion"] == "") {
    $lista = Producto::getProductoPorNombre($_GET["producto"]);
} else if (isset($_GET["ubicacion"]) && isset($_GET["producto"]) && $_GET["producto"] == "") {
    $lista = Producto::getProductosPorUbicacion($_GET["ubicacion"]);
} else if (isset($_GET["producto"]) && isset($_GET["ubicacion"]) && $_GET["producto"] != "" && $_GET["ubicacion"] != "") {
    $lista = Producto::getProductoPorAmbos($_GET["producto"], $_GET["ubicacion"]);
} else if (isset($_GET["detalleProducto"])) {
    $lista = Producto::getDetalleProducto($_GET["detalleProducto"]);
}
echo json_encode($lista);
