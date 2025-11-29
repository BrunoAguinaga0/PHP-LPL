<?php
include_once('producto.class.php');

$criterio = $_GET["criterio"] ?? '';
$filtro = $_GET["filtro"] ?? '';
$busqueda = $_GET["busqueda"] ?? '';
$ubicacion = $_GET["ubicacion"] ?? '';

if ($criterio == "1"){
    if ($filtro == "1"){
        $productos = Producto::buscarProducto($busqueda);
        if (is_null($productos)){
            $listaProductos = [];
        }
        foreach($productos as $producto){
            $listaProductos[] = [
                "producto" => $producto->getProducto(),
                "precio" => $producto->getPrecio(),
                "ubicacion" => $producto->getUbicacion(),
                "supermercado" => $producto->getSupermercado()
            ];
        }
    }else if ($filtro == "2"){
        $productos = Producto::buscarUbicacion($ubicacion);
        if (is_null($productos)){
            $listaProductos = [];
        }else{
            foreach($productos as $producto){
                $listaProductos[] = [
                    "producto" => $producto->getProducto(),
                    "precio" => $producto->getPrecio(),
                    "ubicacion" => $producto->getUbicacion(),
                    "supermercado" => $producto->getSupermercado()
                ];
            }
        }
    }
    echo json_encode($listaProductos);
}else if ($criterio == "2"){
    $productos = Producto::buscoCombinado($busqueda, $ubicacion);
    if (is_null($productos)){
        $listaProductos = [];
    }else{
        foreach($productos as $producto){
            $listaProductos[]= [
                "producto" => $producto->getProducto(),
                "precio" => $producto->getPrecio(),
                "ubicacion" => $producto->getUbicacion(),
                "supermercado" => $producto->getSupermercado()
            ];
        }
    }
    echo json_encode($listaProductos);
}