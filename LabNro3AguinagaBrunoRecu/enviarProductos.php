<?php
include_once('producto.class.php');

$productos = Producto::getProductos();
if (is_null($productos)) {
    echo json_encode([]);
} else {
    foreach ($productos as $producto) {
        $resultado[] = [
            'nombre' => $producto
        ];
    }
    echo json_encode($resultado);
}