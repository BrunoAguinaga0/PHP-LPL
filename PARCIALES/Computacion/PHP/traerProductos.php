<?php
include_once('productos.class.php');
$productos = Productos::buscarProductos();
if (is_null($productos)) {
    $productos = [];
}
echo json_encode($productos);

?>