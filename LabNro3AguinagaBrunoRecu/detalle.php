<?php
include_once('producto.class.php');
$nombre = $_GET['nombre'] ?? '';
$filtro = $_GET['filtro'] ?? '';
$ubicacion = $_GET['ubicacion'] ?? '';
$criterio = $_GET['criterio'] ?? '';
if ($criterio == "1"){
    if ($filtro == "1"){
        $producto = Producto::buscarProducto($nombre);
    }elseif ($filtro == "2"){
        $producto = Producto::buscarUbicacion($ubicacion);
    }
}else{
    $producto = Producto::buscarCombinado($nombre, $ubicacion);
}

function encuentro($producto) {
    if (is_null($producto)) {
        return false;
    } else {
        return true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <article>
            <table>
                <tr>
                    <th>Supermercado</th>
                    <th>Precio</th>
                    <th>Ubicación</th>
                </tr>
            </table>
        </article>
    </section>
</body>
</html>